<?php
namespace MyApp\Utils\DesignPatterns;

trait tSingleton
{
  static protected $instances = [];

  static public function get_instance()
  {
    $key = get_called_class();

    if ( empty( static::$instances[ $key ] ) )
    {
      static::$instances[ $key ] = new static();
    }

    return static::$instances[ $key ];
  }

  protected function __construct() {}
}