<?php
namespace MyApp\Utils\DesignPatterns;

class Singleton
{
  use tSingleton;

  protected function __construct()
  {
    throw new Exception( 'This method is abstract and must be implemented therefore!' );
  }
}