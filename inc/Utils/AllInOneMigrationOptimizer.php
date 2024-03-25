<?php
namespace MyApp\Utils;
use Exception;

if ( ! defined( 'ABSPATH' ) ) exit;

class AllInOneMigrationOptimizer extends \MyApp\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    add_action( 'admin_print_footer_scripts', fn() => $this->print_admin_js() );
  }

  private function print_admin_js() : void
  {
    echo <<<EOF
      <script>
        jQuery( '#ai1wm-export-form .ai1wm-accordion' ).addClass( 'ai1wm-open' )

        jQuery(
          `#ai1wm-no-spam-comments,
          #ai1wm-no-post-revisions,
          #ai1wm-no-media,
          #ai1wm-no-inactive-themes,
          #ai1wm-no-inactive-plugins,
          #ai1wm-no-cache`
        )
        .prop( 'checked', true )
        .trigger( 'change' );
      </script>
      EOF;
  }

  public function add_export_exclusions( array $rel_pathes ) : void
  {
    $pathes = array_map(
      fn( $rel_path ) => basename( MYAPP_ROOT_DIR ) . '/' . $rel_path,
      $rel_pathes
    );

    add_filter(
      $this->get_export_filters_hook_name(),
      fn( $excludes ) => array_merge( $excludes, $pathes )
    );
  }

  private function get_export_filters_hook_name() : string
  {
    // "plugins" or "themes"
    $app_type = basename( dirname( MYAPP_ROOT_DIR ) );

    return "ai1wm_exclude_{$app_type}_from_export";
  }
}