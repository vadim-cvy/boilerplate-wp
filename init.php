<?php
use Cvy\WP\Env\Env;

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'MYAPP_ROOT_PATH', __DIR__ . '/' );
define( 'MYAPP_TEMPLATES_PATH', MYAPP_ROOT_PATH . 'template-parts/' );
define( 'MYAPP_ASSETS_PATH', MYAPP_ROOT_PATH . 'assets/' );
define( 'MYAPP_JS_PATH', MYAPP_ASSETS_PATH . 'js/dist/' );
define( 'MYAPP_CSS_PATH', MYAPP_ASSETS_PATH . 'css/' );

require_once __DIR__ . '/vendor/autoload.php';

Env::get_instance();
Env::set_is_grid_pane( true );

\MyApp\AllInOneWPMigration::get_instance();
