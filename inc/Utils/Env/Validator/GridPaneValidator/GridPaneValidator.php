<?php
namespace MyApp\Utils\Env\Validator\GridPaneValidator;
use MyApp\Utils\Env\Env;
use MyApp\Utils\Env\Validator\Validator;

if (!defined('ABSPATH')) exit;

class GridPaneValidator
{
  static public function validate() : void
  {
    if ( ! Env::is_loc() && file_exists( ABSPATH . '/wp-config.php' ) )
    {
      Validator::add_error( 'wp-config.php file is detected in htdocs dir. It must be removed.' );
    }
  }
}