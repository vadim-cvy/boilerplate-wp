<?php
namespace MyApp\Utils\BBAstSync\ConflictResolvers\BB;

if (!defined('ABSPATH')) exit;

class Typography extends \MyApp\Utils\BBAstSync\ConflictResolvers\CssConflictResolver
{
  protected function get_css() : string
  {
    return '.fl-rich-text *{font-size:1em!important;}';
  }
}