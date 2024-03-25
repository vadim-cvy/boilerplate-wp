<?php
namespace MyApp\Utils\BBAstSync;
use MyApp\Utils\BBAstSync\Util\BB;

if (!defined('ABSPATH')) exit;

class BBAstSync extends \MyApp\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    add_action( 'init', function()
    {
      if (
        ! is_plugin_active( 'bb-plugin/fl-builder.php' )
        && ! is_plugin_active( 'beaver-builder-lite-version/fl-builder.php' )
      )
      {
        trigger_error( 'BB plugin is not active!' );

        return;
      }

      $theme = wp_get_theme();

      if ( ! in_array( 'Astra', [ $theme->name, $theme->parent_theme ] ) )
      {
        trigger_error( 'Astra theme is not active!' );

        return;
      }

      \MyApp\Utils\BBAstSync\ConflictResolvers\BB\Buttons::get_instance();
      \MyApp\Utils\BBAstSync\ConflictResolvers\BB\Typography::get_instance();

      \MyApp\Utils\BBAstSync\ConflictResolvers\Astra\Breakpoints::get_instance();
      \MyApp\Utils\BBAstSync\ConflictResolvers\Astra\Typography::get_instance();
    });
  }
}
