<?php
/*
Plugin Name: Theme Support Realtor
Plugin URI: http://themeforest.net/user/JollyThemes
Description: This plugin is compatible with all wow_themes wordpress themes. 
Author: Shahbaz Ahmed
Author URI: http://wow-themes.com
Version: 1.2
Text Domain: wp_realtor
*/
if( !defined( 'SH_TH_ROOT' ) ) define('SH_TH_ROOT', plugin_dir_path( __FILE__ ));
if( !defined( 'SH_TH_URL' ) ) define( 'SH_TH_URL', plugins_url( '', __FILE__ ) );
if( !defined( 'SH_NAME' ) ) define( 'SH_NAME', 'wp_realtor' );
include_once( 'includes/loader.php' );