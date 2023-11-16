<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/init.php';

// todo: exeucute `composer require cvy/util-wp-assets`
// todo: if Astra child theme - add 'astra' dependency
(new Cvy\WP\Assets\CSS( '../../../style.css' ))->enqueue();