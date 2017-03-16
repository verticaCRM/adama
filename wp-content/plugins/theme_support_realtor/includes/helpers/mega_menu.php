<?php
include( 'walker.php' );

class SH_Mega_menu extends MegaMenuWalker
{
	

	function __construct()

	{

		/** Appearance > Menus : modify menu item options */
		add_filter( 'wp_edit_nav_menu_walker', array($this , 'editWalker'), 2000);
		

		/** Appearance > Menus : save custom menu options */
		add_action( 'wp_update_nav_menu_item', array($this , 'updateNavMenuItem'), 10, 3); //, $menu_id, $menu_item_db_id, $args;
		
		add_action('megamenu_menu_item_options', array($this , 'menuItemCustomOptions'), 10, 5);		//Must go here for AJAX purposes
		
		add_action( 'admin_print_scripts-nav-menus.php', array($this, 'admin_script'), 11 );
			
		if( ! is_admin())
		{
			add_filter( 'wp_nav_menu_args' , array( $this , 'megaMenuFilter' ), 2000 );  	//filters arguments passed to wp_nav_menu
		}

	}

	

	function admin_script()

	{

		wp_enqueue_script('megamenu-scripts', SH_TH_URL.'/includes/resource/js/megamenu_script.js');

		wp_enqueue_style('megamenu-styles', SH_TH_URL.'/includes/resource/css/style.css');

	}

	

	/** Add custom fields in Menus > area in admin*/

	function editWalker($class)

	{
		return 'MegaMenuWalkerEdit';
	}

	

	function updateNavMenuItem($menu_id, $menu_item_db_id, $args)

	{

		$isTopLevel = $args['menu-item-parent-id'] == 0 ? true : false;
		$sidebar = '';

		if(!$isTopLevel)
		{

			$parent_id = $args['menu-item-parent-id'];

			$parent_status = get_post_meta($parent_id, '_menu_item_status', true);

			update_post_meta( $menu_item_db_id, '_menu_item_status', $parent_status );
			

		}else

		{
			$status = 'inactive';

			if(isset( $_POST['megamenu_status'][$menu_item_db_id] ) && $_POST['megamenu_status'][$menu_item_db_id] == 'active')
				$status = 'active';

			update_post_meta( $menu_item_db_id, '_menu_item_status', $status );
		}

		//printr($_POST);

		if($isTopLevel)

		{

			/** Store other fields*/
			update_post_meta( $menu_item_db_id, '_sh_menu_columns', sh_set( sh_set( $_POST, '_sh_menu_columns'), $menu_item_db_id, 2 ) );
			
		}
		
		if(isset( $_POST['_sh_menu_sidebar'][$menu_item_db_id] ) && !empty($_POST['_sh_menu_sidebar'][$menu_item_db_id]))
				$sidebar = $_POST['_sh_menu_sidebar'][$menu_item_db_id];

		update_post_meta( $menu_item_db_id, '_sh_menu_sidebar', $sidebar );
		
		update_post_meta( $menu_item_db_id, '_sh_menu_item_submenu_type', sh_set( sh_set( $_POST, 'menu_item_submenu_type'), $menu_item_db_id, 'default_dropdown' ) );

	}

	

			

	function menuItemCustomOptions($item_id, $object, $depth = 0, $args = array(), $current_object_id = 0)
	{

		global $wp_registered_sidebars;

		$isTop = (get_post_meta($item_id, '_menu_item_menu_item_parent', true)) ? true : true;

		if($isTop) require(SH_TH_ROOT.'/includes/resource/views/menu_fields.php');

	}
	

	/*
	 * Apply options to the Menu via the filter
	 */
	function megaMenuFilter($args)
	{
		/** Don't do anything in IE6 */

		if( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 6') !== false ) return $args;

		/** Check to See if this Menu Should be Megafied */
		$location = $args['theme_location'];

		if( $location == 'main_menu' )
		{
			$args['walker'] 			= new MegaMenuWalker();
	
			$args['menu_class']			= 'megaMenu';
	
			$args['depth']				= 3;
	
		}

		return $args;
	}
	
}

