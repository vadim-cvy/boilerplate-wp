<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/init.php';

// todo: exeucute `composer require cvy/util-wp-assets`
Cvy\WP\Assets\Main::set_app_namespace( 'myapp' );

// todo: if Astra child theme - add 'astra-theme-css' dependency
(new Cvy\WP\Assets\CSS( '../../../style.css' ))->enqueue();