<?php
if ( ! defined( 'ABSPATH' ) ) exit;


require_once __DIR__ . '/vendor/autoload.php';


/**
 * Base Constants
 */
define( 'MYAPP_ROOT_PATH', __DIR__ . '/' );
define( 'MYAPP_TEMPLATES_PATH', MYAPP_ROOT_PATH . 'template-parts/' );


/**
 * Validate environment (CVY_ENV constant must defined in wp-config.php).
 * @see https://github.com/vadim-cvy/util-wp-env
 */
Cvy\WP\Env\Env::get_instance();
// todo: remove the next line if site won't be hosted on gridpane
Cvy\WP\Env\Env::set_is_grid_pane( true );


/**
 * Resolve Astra/BB conflicts + sync some of their settings.
 * @see https://github.com/vadim-cvy/util-wp-beaver-builder-astra-compatibility/
 */
\Cvy\WP\BBAstrCompat\Main::get_instance();


/**
 * Reduce WP All In One Migration export file size.
 * @see https://github.com/vadim-cvy/util-wp-all-in-one-migration/
 */
Cvy\WP\AllInOneMigration\Main::get_instance()
  ->set_app_root_dir( MYAPP_ROOT_PATH )
  ->add_base_export_exclusions()
  ->add_export_exclusions([
    'assets/src',
    'webpack.base.config.js',
    'webpack.dev.config.js',
    'webpack.prod.config.js',
  ]);


/**
 * Set up assets util and enqueue main stylesheet of this theme.
 * @see https://github.com/vadim-cvy/util-wp-assets
 */
Cvy\WP\Assets\Main::set_app_namespace( 'myapp' );

if ( ! is_admin() )
{
  (new Cvy\WP\Assets\CSS( '../../../style.css', [ 'astra-theme-css' ] ))->enqueue();
}