<?php
namespace MyApp\Utils\Env\Validator;

use MyApp\Utils\Env\Env;
use MyApp\Utils\Env\Validator\ConstantsValidator\ConstantsValidator;
use MyApp\Utils\Env\Validator\GridPaneValidator\GridPaneValidator;
use MyApp\Utils\Env\Validator\DependenciesValidator\DependenciesValidator;
use MyApp\Utils\Env\Validator\DependenciesValidator\Plugin;
use MyApp\Utils\Assets;

if (!defined('ABSPATH')) exit;

class Validator extends \MyApp\Utils\DesignPatterns\Singleton
{
  static protected $critical_errors = [];

  static protected $general_errors = [];

  protected function __construct()
  {
    add_action( 'init', fn() => $this->validate() );

    add_action( 'admin_init', fn() => $this->show_errors() );
    add_action( 'wp', fn() => $this->show_errors() );
  }

  private function validate() : void
  {
    $this->validate_debug_constants();

    $this->validate_plugin_dependencies();

    $this->validate_search_engine_visibility();

    if ( MYAPP_IS_GRIDPANE )
    {
      GridPaneValidator::validate();
    }
  }

  private function validate_debug_constants() : void
  {
    $debug_log_allowed_values = [];
    $debug_log_allowed_values[] = Env::is_loc() ? true : dirname( ABSPATH ) . '/logs/debug.log';

    ConstantsValidator::validate_soft( 'WP_DEBUG', [ true ] );
    ConstantsValidator::validate_soft( 'WP_DEBUG_LOG', $debug_log_allowed_values );
    ConstantsValidator::validate_soft( 'WP_DEBUG_DISPLAY', [ Env::is_loc() ] );

    ConstantsValidator::validate_soft( 'MYAPP_IS_GRIDPANE', [ true, false ] );
  }

  private function validate_plugin_dependencies() : void
  {
    DependenciesValidator::validate_plugin(
      new Plugin( 'Query Monitor', 'query-monitor/query-monitor.php' ),
      DependenciesValidator::STATE_DISABLED,
      DependenciesValidator::STATE_ENABLED
    );

    DependenciesValidator::validate_plugin(
      new Plugin( 'WP Mail Logging', 'wp-mail-logging/wp-mail-logging.php' ),
      DependenciesValidator::STATE_DISABLED,
      DependenciesValidator::STATE_ENABLED
    );

    DependenciesValidator::validate_plugin(
      new Plugin( 'Disable Emails', 'disable-emails/disable-emails.php' ),
      DependenciesValidator::STATE_DISABLED_CRITICAL,
      DependenciesValidator::STATE_ENABLED_CRITICAL
    );

  }

  private function validate_search_engine_visibility() : void
  {
    $settings_page_url = get_admin_url( null, 'options-reading.php' );

    $error_msg_template = "Search engine visibility must be <a href='$settings_page_url'>%s</a>!";

    $is_enabled = get_option( 'blog_public' );

    if ( Env::is_prod() && ! $is_enabled )
    {
      static::add_error( sprintf( $error_msg_template, 'enabled' ) );
    }
    else if ( ! Env::is_prod() && $is_enabled )
    {
      static::add_error( sprintf( $error_msg_template, 'disabled' ) );
    }
  }

  static public function add_error( string $msg, bool $is_critical = false ) : void
  {
    if ( $is_critical )
    {
      static::$critical_errors[] = $msg;
    }
    else
    {
      static::$general_errors[] = $msg;
    }
  }

  private function show_errors() : void
  {
    if ( empty( static::$critical_errors ) && empty( static::$general_errors ) )
    {
      return;
    }

    if ( ! static::is_user_authorized_see_errors() )
    {
      if ( ! empty( static::$critical_errors ) )
      {
        $this->die('');
      }
      else
      {
        return;
      }
    }


    $js_handle = Assets::enqueue_local_js( 'env-validator' );

    wp_localize_script( $js_handle, 'myappEnvValidator', [
      'errors' => [
        'general' => static::$general_errors,
        'critical' => static::$critical_errors,
      ],
      'env' => Env::get_env(),
    ]);
  }

  static public function die( string $msg ) : void
  {
    if ( static::is_user_authorized_see_errors() )
    {
      $title = 'Setup Error';

      $msg = 'Environment setup <b>critical error</b>: ' . $msg;
    }
    else
    {
      $title = 'Scheduled maintenance';

      $msg = 'We\'re currently undergoing scheduled maintenance. Please come back in 10 minutes. Thank you for your patience!';
    }

    wp_die( $msg, $title );
  }

  static public function is_user_authorized_see_errors() : bool
  {
    return ! Env::is_prod() || current_user_can( 'administrator' );
  }
}