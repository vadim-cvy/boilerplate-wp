<?php
namespace MyApp\SitePages;

if ( ! defined( 'ABSPATH' ) ) exit;

class SinglePage extends \Cvy\WP\SitePages\Singular
{
  protected function get_post_type() : string
  {
    return 'page';
  }

  protected function enqueue_assets() : void
  {
    (new \Cvy\WP\Assets\CSS( 'single-page.css' ))->enqueue();
  }
}