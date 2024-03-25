<?php
namespace MyApp\Utils\BBAstSync\ConflictResolvers\Astra;

use MyApp\Utils\BBAstSync\Util\BB;
use FLBuilderModel;

if (!defined('ABSPATH')) exit;

class Breakpoints extends \MyApp\Utils\BBAstSync\ConflictResolvers\ConflictResolver
{
  protected function __construct()
  {
    add_filter( 'astra_tablet_breakpoint', fn() => $this->get_tablet_breakpoint() );
    add_filter( 'astra_mobile_breakpoint', fn() => $this->get_mobile_breakpoint() );
  }

  static public function get_tablet_breakpoint() : int
  {
    return FLBuilderModel::get_global_settings()->large_breakpoint;
  }

  static public function get_mobile_breakpoint() : int
  {
    return FLBuilderModel::get_global_settings()->responsive_breakpoint;
  }
}