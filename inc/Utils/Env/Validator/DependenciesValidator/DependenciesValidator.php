<?php
namespace MyApp\Utils\Env\Validator\DependenciesValidator;
use MyApp\Utils\Env\Env;
use MyApp\Utils\Env\Validator\Validator;

if (!defined('ABSPATH')) exit;

class DependenciesValidator
{
  const STATE_ENABLED_CRITICAL = 2;

  const STATE_ENABLED = 1;

  const STATE_NEUTRAL = 0;

  const STATE_DISABLED = -1;

  const STATE_DISABLED_CRITICAL = -2;

  static public function validate_plugin(
    Plugin $plugin,
    int $prod_state,
    int $stg_state,
    int $loc_state = null
  ) : void
  {
    if ( ! isset( $loc_state ) )
    {
      $loc_state = $stg_state;
    }

    $expected_state = ${Env::get_env() . '_state'};

    $error_msg = static::get_error_msg( $plugin, $expected_state );

    if ( ! $error_msg )
    {
      return;
    }

    $is_critical = in_array( $expected_state, [
      static::STATE_ENABLED_CRITICAL,
      static::STATE_DISABLED_CRITICAL
    ]);

    if ( $is_critical && ! is_admin() )
    {
      Validator::die( $error_msg );
    }
    else
    {
      Validator::add_error( $error_msg, $is_critical );
    }
  }

  static private function get_error_msg( Plugin $plugin, int $expected_state ) : string
  {
    $msg_template =
      "The following plugin must be %s: <a href='{$plugin->get_url()}'>{$plugin->get_name()}</a>!";

    switch ( $expected_state )
    {
      case static::STATE_ENABLED:
      case static::STATE_ENABLED_CRITICAL:
        if ( ! $plugin->is_active() )
        {
          return sprintf( $msg_template, 'activated' );
        }
        break;

      case static::STATE_DISABLED:
      case static::STATE_DISABLED_CRITICAL:
        if ( $plugin->is_active() )
        {
          return sprintf( $msg_template, 'deactivated' );
        }
        break;

      case static::STATE_NEUTRAL:
        break;

      default:
        throw new \Exception( 'Something goes wrong!' );
    }

    return '';
  }
}