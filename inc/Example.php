<?php
namespace MyApp;

if ( ! defined( 'ABSPATH' ) ) exit;

class Example
{
  public function __construct()
  {
    error_log( 'Hello :)' );
  }
}