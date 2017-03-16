<?php if ( ! defined('ABSPATH')) exit('restricted access'); 


class SH_Shortcode_editor
{
	/** Constructor to load default hooks */
	function __construct()
	{		
		if(is_admin())
		{
			// init process for button control
			add_action('init', array($this, 'add_buttons'));

			add_action('admin_footer', array($this, 'admin_footer'));
		}
	}
	
	/** Shortcoder tinyMCE buttons */
	function add_buttons()
	{
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	 
	   if ( get_user_option('rich_editing') == 'true') 
	   {
		 add_filter("mce_external_plugins", array($this, "add_tinymce_plugin"));
		 add_filter('mce_buttons', array($this, 'register_button'));
	   }
	}
	
	/** Register a new button into WP editor */
	function register_button($buttons)
	{
	   array_push($buttons, "|", "scbutton");
	   return $buttons;
	}
	
	function add_tinymce_plugin($plugin_array)
	{
	   $plugin_array['fwbutton'] = get_template_directory_uri() . '/js/shortcode_button.js';
	   return $plugin_array;
	}
	
	
	/** Add the url to send Popup request */
	function admin_footer()
	{
		if(in_array($GLOBALS['pagenow'], array('post.php', 'post-new.php'))){
			echo '<span id="sc_editorUrl" style="display:none;">' . home_url(). '?sh_shortcode_editor_action=shortcode</span>';
		}
	}

}
