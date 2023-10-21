<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'JLX_ROOT_PATH', __DIR__ . '/' );
define( 'JLX_TEMPLATES_PATH', JLX_ROOT_PATH . 'template-parts/' );
define( 'JLX_ASSETS_PATH', JLX_ROOT_PATH . 'assets/' );
define( 'JLX_JS_PATH', JLX_ASSETS_PATH . 'js/dist/' );
define( 'JLX_CSS_PATH', JLX_ASSETS_PATH . 'css/' );

require_once __DIR__ . '/vendor/autoload.php';

\MyApp\Example::do_something();
