<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'MYAPP_ROOT_PATH', __DIR__ . '/' );
define( 'MYAPP_TEMPLATES_PATH', MYAPP_ROOT_PATH . 'template-parts/' );
define( 'MYAPP_ASSETS_PATH', MYAPP_ROOT_PATH . 'assets/' );
define( 'MYAPP_JS_PATH', MYAPP_ASSETS_PATH . 'js/dist/' );
define( 'MYAPP_CSS_PATH', MYAPP_ASSETS_PATH . 'css/' );

require_once __DIR__ . '/vendor/autoload.php';

\MyApp\Example::do_something();
