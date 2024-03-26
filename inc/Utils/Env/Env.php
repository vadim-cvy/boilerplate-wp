<?php
namespace MyApp\Utils\Env;

use Exception;

if ( ! defined( 'ABSPATH' ) ) exit();

class Env extends \MyApp\Utils\DesignPatterns\Singleton
{
  static public function get_env() : string
  {
    return MYAPP_ENV;
  }

  static public function is_prod() : bool
  {
    return static::get_env() === 'prod';
  }

  static public function is_stg() : bool
  {
    return static::get_env() === 'stg';
  }

  static public function is_loc() : bool
  {
    return static::get_env() === 'loc';
  }
}