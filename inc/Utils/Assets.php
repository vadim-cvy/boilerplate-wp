<?php
namespace MyApp\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

class Assets
{
  static public function enqueue_external_js( string $handle_base, string $src ) : string
  {
    $handle = static::prefix_asset_handle( $handle_base );

    static::enqueue_js( $handle, $src, [], null, true );

    return $handle;
  }

  static public function enqueue_local_js( string $basedir_rel_path, array $deps = [] ) : string
  {
    $handle = static::get_local_asset_handle( $basedir_rel_path );

    static::enqueue_js(
      $handle,
      static::get_local_asset_url( $basedir_rel_path, 'js' ),
      $deps,
      static::get_local_asset_version( $basedir_rel_path, 'js' ),
      true
    );

    return $handle;
  }

  static private function enqueue_js( string $handle, string $src, array $deps, string $version ) : void
  {
    $cb = fn() => wp_enqueue_script( $handle, $src, $deps, $version, true );

    if ( did_action( 'wp_footer' ) || did_action( 'admin_footer' ) )
    {
      throw new Exception( 'Too late to enqueue js, "wp_footer"/"admin_footer" action has fired already!' );
    }
    else if ( ! did_action( 'wp_enqueue_scripts' ) && ! did_action( 'admin_enqueue_scripts' ) )
    {
      add_action( 'admin_enqueue_scripts', $cb );
      add_action( 'wp_enqueue_scripts', $cb );
    }
    else
    {
      $cb();
    }
  }

  static public function enqueue_external_css( string $handle_base, string $src ) : string
  {
    $handle = static::prefix_asset_handle( $handle_base );

    static::enqueue_css( $handle, $src, [], null );

    return $handle;
  }

  static public function enqueue_local_css( string $basedir_rel_path, array $deps = [] ) : string
  {
    $handle = static::get_local_asset_handle( $basedir_rel_path );

    static::enqueue_css(
      $handle,
      static::get_local_asset_url( $basedir_rel_path, 'css' ),
      $deps,
      static::get_local_asset_version( $basedir_rel_path, 'css' )
    );

    return $handle;
  }

  static private function enqueue_css( string $handle, string $src, array $deps, string $version ) : void
  {
    $cb = fn() => wp_enqueue_style( $handle, $src, $deps, $version );

    if ( in_array( current_action(), [ 'admin_enqueue_scripts', 'wp_enqueue_scripts' ] ) )
    {
      $cb();
    }
    else if ( did_action( 'admin_enqueue_scripts' ) || did_action( 'wp_enqueue_scripts' ) )
    {
      throw new Exception( 'Too late to enqueue css, "admin_enqueue_scripts"/"wp_enqueue_scripts" action has fired already!' );
    }
    else
    {
      add_action( 'admin_enqueue_scripts', $cb );
      add_action( 'wp_enqueue_scripts', $cb );
    }
  }

  static private function prefix_asset_handle( string $handle_base ) : string
  {
    return 'myapp_' . $handle_base;
  }

  static private function get_local_asset_handle( string $basedir_rel_path ) : string
  {
    $handle_base = preg_replace( '/[^-\/a-z]/', '', $basedir_rel_path );
    $handle_base = str_replace( '/', '_', $handle_base );

    return static::prefix_asset_handle( $handle_base );
  }

  static private function get_local_asset_url( string $basedir_rel_path, string $asset_type )
  {
    $file_path = static::get_local_asset_path( $basedir_rel_path, $asset_type );

    $is_theme = basename( dirname( MYAPP_ROOT_DIR ) ) === 'themes';

    if ( $is_theme )
    {
      $file_rel_path = str_replace( MYAPP_ROOT_DIR, '', $file_path );

      return get_stylesheet_directory_uri() . '/' . $file_rel_path;
    }
    else
    {
      return plugin_dir_url( $file_path ) . basename( $file_path );
    }
  }

  static private function get_local_asset_version( string $basedir_rel_path, string $asset_type ) : string
  {
    return filemtime( static::get_local_asset_path( $basedir_rel_path, $asset_type ) );
  }

  static private function get_local_asset_path( string $basedir_rel_path, string $asset_type ) : string
  {
    return MYAPP_ROOT_DIR . "assets/dist/$asset_type/$basedir_rel_path/index.$asset_type";
  }
}