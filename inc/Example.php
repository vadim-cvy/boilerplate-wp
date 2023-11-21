<?php
namespace MyApp;

if ( ! defined( 'ABSPATH' ) ) exit;

class Example extends \Cvy\DesignPatterns\Singleton
{
  protected function __construct()
  {
    error_log( 'Hello :)' );
  }
}