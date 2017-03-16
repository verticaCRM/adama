<?php



/** Include the TGM_Plugin_Activation class. */

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );



function my_theme_register_required_plugins()

{



	$plugins = array(

		array(

            'name'               => 'Theme Support (Required)', // The plugin name.

            'slug'               => 'theme_support_realtor', // The plugin slug (typically the folder name).

            'source'             => get_template_directory() . '/includes/thirdparty/tgm-plugin-activation/plugins/theme_support_realtor.zip', // The plugin source.

            'required'           => true, // If false, the plugin is only 'recommended' instead of required.

            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.

            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.

            'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.

            'external_url'       => '', // If set, overrides default API URL and points to an external URL.

        ),

		array(

			'name'     				=> 'Revolution Slider',

			'slug'     				=> 'revslider',

			'source'				  => SH_ROOT. '/includes/thirdparty/tgm-plugin-activation/plugins/revslider.zip',

			'required' 				=> true,

			'version' 				 => '5.0.6',

			'force_activation' 		=> false,

			'force_deactivation' 	  => false,

			'external_url' 			=> SH_URL . '/includes/thirdparty/tgm-plugin-activation/plugins/revslider.zip',

			'file_path'			   =>  ABSPATH.'wp-content/plugins/revslider/revslider.php'

		),

		array(

			'name'     				=> 'WPBakery Visual Composer',

			'slug'     				=> 'js_composer',

			'source'   				  => SH_ROOT . '/includes/thirdparty/tgm-plugin-activation/plugins/js_composer.zip',

			'required' 				=> true,

			'version' 				 => '4.7',

			'force_activation' 		=> false,

			'force_deactivation' 	  => false,

			'external_url' 			=> SH_URL . '/includes/thirdparty/tgm-plugin-activation/plugins/js_composer.zip',

			'file_path'			   =>  ABSPATH.'wp-content/plugins/js_composer/js_composer.php'

		),

	);



	// Change this to your theme text domain, used for internationalising strings

	$theme_text_domain = SH_NAME;



	$config = array(

		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.

		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins

		//'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug

		//'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug

		'menu'         		=> 'install-required-plugins', 	// Menu slug

		'has_notices'      	=> true,                       	// Show admin notices or not

		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not

		'message' 			=> '',							// Message to output right before the plugins table

		'strings'      		=> array(

			'page_title'                       			=> esc_html__( 'Install Required Plugins', SH_NAME ),

			'menu_title'                       			=> esc_html__( 'Install Plugins', SH_NAME ),

			'installing'                       			=> esc_html__( 'Installing Plugin: %s', SH_NAME ), // %1$s = plugin name

			'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', SH_NAME ),

			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)

			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)

			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)

			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)

			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)

			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)

			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)

			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)

			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),

			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),

			'return'                           			=> esc_html__( 'Return to Required Plugins Installer', SH_NAME ),

			'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', SH_NAME ),

			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', SH_NAME ), // %1$s = dashboard link

			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'

		)

	);



	tgmpa($plugins, $config);

}