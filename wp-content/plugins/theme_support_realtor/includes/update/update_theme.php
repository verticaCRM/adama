<?php

class SH_Update_Theme
{
	/**/
	// TEMP: Enable update check on every request. Normally you don't need this! This is for testing only!
	//set_site_transient('update_themes', null);
	
	// NOTE: All variables and functions will need to be prefixed properly to allow multiple plugins to be updated
	
	/******************Change this*******************/
	var $api_url = 'http://demos.megawpthemes.com/_wowthemes_updates/';
	/************************************************/
	
	/*******************Child Theme******************
	//Use this section to provide updates for a child theme
	//If using on child theme be sure to prefix all functions properly to avoid 
	//function exists errors
	if(function_exists('wp_get_theme')){
		$theme_data = wp_get_theme(get_option('stylesheet'));
		$theme_version = $theme_data->Version;  
	} else {
		$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css');
		$theme_version = $theme_data['Version'];
	}    
	$theme_base = get_option('stylesheet');
	**************************************************/
	
	
	/***********************Parent Theme**************/
	
	private $purchase_code;
	private $purchase_user;
	private $errors;
	
	function __construct()
	{
		$this->launch();
	}
	
	function launch()
	{
		
		$theme_options = _WSH()->option();
		$theme_options_url = admin_url( 'themes.php?page='.SH_NAME.'_option' );
		
		$this->purchase_code = sh_set( $theme_options, 'sh_purchase_code' );
		
		$this->purchase_user = sh_set( $theme_options, 'sh_purchase_user' );
				
		if(function_exists('wp_get_theme')){
			$this->theme_data = wp_get_theme(get_option('template'));
			$this->theme_version = $this->theme_data->Version;  
		} else {
			$this->theme_data = get_theme_data( get_template_directory() . '/style.css');
			$this->theme_version = $this->theme_data['Version'];
		}
		 
		$this->theme_base = get_option('template');

		if( !$this->purchase_code && !$this->purchase_user ) {
			$this->errors[] = sprintf(__('<strong>%s Theme Notice:</strong> Please enter a valid <a href="%s">purchase code and themeforest username</a> to get automatic theme update', SH_NAME), $this->theme_data['Name'], $theme_options_url);
		}
		
		add_action( 'admin_notices', array( $this, '_admin_notice' ) );
		
		if( $this->errors ) return;
		
		/**************************************************/

		//Uncomment below to find the theme slug that will need to be setup on the api server
		//var_dump($theme_base);

		add_filter('pre_set_site_transient_update_themes', array( $this, 'check_for_update' ) );
		
		// Take over the Theme info screen on WP multisite
		add_filter('themes_api', array( $this, 'my_theme_api_call' ), 10, 3);
		
		if (is_admin())
			$this->current = get_transient('update_themes');
		

	}

	
	function _admin_notice()
	{
		if( $this->errors )
			foreach( $this->errors as $error ):?>
        
                <div class="updated">
                    <p><?php echo $error; ?></p>
                </div>
                <?php
			endforeach;
		
	}
	
	
	function check_for_update($checked_data) {
		global $wp_version;
	
		$api_url = $this->api_url;
		$theme_base = $this->theme_base;
		$theme_version = $this->theme_version;
		
		$request = array(
			'slug' => $theme_base,
			'version' => $theme_version,
			'purchase_code' => $this->purchase_code,//'3f2802a5-bd6b-474e-b9cb-e53095bdcdbc',//$this->purchase_code,
			'purchase_user' => $this->purchase_user//'d1anonlyway',//$this->purchase_user, 
		);
		// Start checking for an update
		$send_for_check = array(
			'body' => array(
				'action' => 'theme_update', 
				'request' => serialize($request),
				'api-key' => md5(home_url())
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
		);
		
		$raw_response = wp_remote_post($api_url, $send_for_check);
		
		if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
			$response = unserialize($raw_response['body']);
	
		// Feed the update data into WP updater
		if (!empty($response)) 
			$checked_data->response[$theme_base] = $response;
	
		return $checked_data;
	}


	function my_theme_api_call($def, $action, $args) 
	{

		
		$api_url = $this->api_url;
		$theme_base = $this->theme_base;
		$theme_version = $this->theme_version;

		
		if ($args->slug != $theme_base)
			return false;
		
		// Get the current version
	
		$args->version = $theme_version;
		$request_string = prepare_request($action, $args);
		$request = wp_remote_post($api_url, $request_string);
	
		if (is_wp_error($request)) {
			$res = new WP_Error('themes_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>', SH_NAME), $request->get_error_message());
		} else {
			$res = unserialize($request['body']);
			
			if ($res === false)
				$res = new WP_Error('themes_api_failed', __('An unknown error occurred', SH_NAME), $request['body']);
		}
		
		return $res;
	}




}