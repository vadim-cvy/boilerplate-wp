<?php
namespace MyApp;

if ( ! defined( 'ABSPATH' ) ) exit;

// todo: exeucute `composer require cvy/util-design-patterns` if you want to keep this class in your project.
class AllInOneWPMigration extends \Cvy\DesignPatterns\Singleton
{
  protected function __construct()
  {
    $this->exclude_node_modules();
  }

  public function exclude_node_modules() : void
  {
    $hook_name = 'ai1wm_exclude_' . basename( dirname( MYAPP_ROOT_PATH ) ) . '_from_export';

    add_filter( $hook_name, function( array $exclude_rules ) : array
    {
      $exclude_filters[] = basename( MYAPP_ROOT_PATH ) . 'node_modules';

      return $exclude_filters;
    });
  }
}