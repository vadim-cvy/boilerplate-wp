<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'MYAPP_ROOT_DIR', __DIR__ . '/' );
define( 'MYAPP_TEMPLATES_DIR', MYAPP_ROOT_DIR . 'template-parts/' );

require_once __DIR__ . '/vendor/autoload.php';

MyApp\Utils\Env\Validator\Validator::get_instance();

// Todo: remove this call and '/inc/Utils/BBAstSync' dir if you don't use "Astra" theme and "Beaver Builder" plugin.
MyApp\Utils\BBAstSync\BBAstSync::get_instance();

// Todo: remove this call and '/inc/Utils/AllInOneMigrationOptimizer.php' if you don't use "All in One WP Migration" plugin.
MyApp\Utils\AllInOneMigrationOptimizer::get_instance()->add_export_exclusions([
  '.vscode',
  '.git',
  '.gitignore',
  'composer.json',
  'composer.lock',
  'package.json',
  'package.lock',
  'gulpfile.js',
  'tsconfig.json',
  'webpack.config.js',
  'README.md',
  'node_modules',
  'assets/src',
]);

if ( ! is_admin() )
{
  MyApp\Utils\Assets::enqueue_local_css( 'global', [ 'astra-theme-css' ] );
}
