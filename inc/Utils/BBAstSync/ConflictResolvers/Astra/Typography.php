<?php
namespace MyApp\Utils\BBAstSync\ConflictResolvers\Astra;
use Astra_Theme_Options;

if (!defined('ABSPATH')) exit;

class Typography extends \MyApp\Utils\BBAstSync\ConflictResolvers\CssConflictResolver
{
  protected function get_css() : string
  {
    $css = '';

    $font_size_settings = Astra_Theme_Options::get_options()['font-size-body'];

    foreach ( [ 'desktop', 'tablet', 'mobile' ] as $screen_size )
    {
      $font_size_value = $font_size_settings[ $screen_size ];
      $font_size_unit = $font_size_settings[ $screen_size . '-unit' ];

      $screen_size_css = 'html{font-size:' . $font_size_value . $font_size_unit . '!important}';

      if ( $screen_size !== 'desktop' )
      {
        $screen_size_css = sprintf( '@media screen and (max-width:%dpx){%s}',
          Breakpoints::{'get_' . $screen_size . '_breakpoint'}(),
          $screen_size_css,
        );
      }

      $css .= $screen_size_css;
    }

    $css .= 'body{font-size:inherit!important;}';

    return $css;
  }
}