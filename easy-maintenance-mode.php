<?php
/*
Plugin Name: Easy Maintenance Mode
Plugin URI: https://www.travishoglund.com
Description: Allows you to easily put your site into maintenance mode
Version: 1.0
Author: Travis Hoglund
Author URI: https://www.travishoglund.com
License: GPLv2 or later
Text Domain: easy-maintenance-mode
*/

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

define( 'TH_EMM_DEBUG', false );
define( 'TH_EMM_VERSION', '1.0' );
define( 'TH_EMM_DOMAIN', 'easy-maintenance-mode' );
define( 'TH_EMM_PATH', plugin_dir_path( __FILE__ ) );
define( 'TH_EMM_RELATIVE_WP_PATH', str_replace( ABSPATH, '/', TH_EMM_PATH ) );
define( 'TH_EMM_BASENAME', plugin_basename( __FILE__ ) );
define( 'TH_EMM_MAINTENANCE_TITLE', __( 'Maintenance Mode', TH_EMM_DOMAIN ) );
define( 'TH_EMM_MAINTENANCE_DESCRIPTION',
	__( 'This site is currently under maintenance.  Please check back shortly!', TH_EMM_DOMAIN ) );

require_once( dirname( __FILE__ ) . '/classes/class-th-easy-maintenance-mode.php' );
