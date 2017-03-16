<?php

add_action('after_setup_theme', 'sh_theme_setup');

function sh_theme_setup()
{
	
	global $wp_version;
	if(!defined('SH_VERSION')) define('SH_VERSION', '1.0');
	if( !defined( 'SH_NAME' ) ) define( 'SH_NAME', 'wp_adama' );
	if( !defined( 'SH_ROOT' ) ) define('SH_ROOT', get_template_directory().'/');
	if( !defined( 'SH_URL' ) ) define('SH_URL', get_template_directory_uri().'/');	
	include_once( 'includes/loader.php' );
	
	load_theme_textdomain(SH_NAME, get_template_directory() . '/languages');
	add_editor_style();
	//ADD THUMBNAIL SUPPORT
	add_theme_support('post-thumbnails');
	//add_theme_support( 'post-formats', array( 'gallery', 'image', 'quote', 'video', 'audio' ) );
	add_theme_support('menus'); //Add menu support
	add_theme_support('automatic-feed-links'); //Enables post and comment RSS feed links to head.
	add_theme_support('widgets'); //Add widgets and sidebar support
	add_theme_support( 'woocommerce' );
	add_theme_support( "title-tag" );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	/** Register wp_nav_menus */
	if(function_exists('register_nav_menu'))
	{
		register_nav_menus(
			array(
				/** Register Main Menu location header */
				'top_left_menu' => esc_html__('Top Left Menu', SH_NAME),
				'top_right_menu' => esc_html__('Top Right Menu', SH_NAME),
				'main_menu' => esc_html__('Main Menu', SH_NAME),
				'main_menu_2' => esc_html__('Main Menu 2', SH_NAME),
				'footer_menu' => esc_html__('Footer Menu', SH_NAME),
			)
		);
	}
	if ( ! isset( $content_width ) ) $content_width = 960;
	add_image_size( '163x150', 163, 150, true );
	add_image_size( '271x337', 271, 337, true );
	add_image_size( '370x230', 370, 230, true );
	add_image_size( '270x288', 270, 288, true );
	add_image_size( '86x86', 86, 86, true );
	add_image_size( '867x430', 867, 430, true );
	add_image_size( '54x54', 54, 54, true );
	add_image_size( '370x260', 370, 260, true );
	add_image_size( '91x91', 91, 91, true );
	add_image_size( '1140x475', 1140, 475, true );
	

	if(sh_set(_WSH()->option(), 'compress_js_css') && !class_exists('Minit')){
		include_once 'includes/helpers/minit.php';
	}
}


function sh_widget_init()
{
	global $wp_registered_sidebars;
	$theme_options = _WSH()->option();
	if( class_exists( 'SH_SocialMedia' ) )register_widget( 'SH_SocialMedia' );
	if( class_exists( 'SH_categories' ) )register_widget( 'SH_categories' );
	if( class_exists( 'SH_featured_properties' ) )register_widget( 'SH_featured_properties' );
	if( class_exists( 'SH_Foot_Features' ) )register_widget( 'SH_Foot_Features' );
    if( class_exists( 'SH_Recent_Posts' ) )register_widget( 'SH_Recent_Posts' );
	if( class_exists( 'SH_Search' ) )register_widget( 'SH_Search' );
	if( class_exists( 'SH_feedburner' ) )register_widget( 'SH_feedburner' );
	if( class_exists( 'SH_Contactinfo' ) )register_widget( 'SH_Contactinfo' );
	if( class_exists( 'SH_Twitter' ) )register_widget( 'SH_Twitter' );
	
	
	if( class_exists( 'SH_Call_Out' ) )register_widget( 'SH_Call_Out' );
	register_sidebar(array(
	  'name' => esc_html__( 'Default Sidebar', SH_NAME ),
	  'id' => 'default-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', SH_NAME ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s" class="widget m0 clearfix %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h4 class="heading">',
	  'after_title' => '</h4>'
	));
	register_sidebar(array(
	  'name' => esc_html__( 'Footer Top Sidebar', SH_NAME ),
	  'id' => 'footer-top-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown in Footer Area.', SH_NAME ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s"  class="footFeature %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h4>',
	  'after_title' => '</h4>'
	));
	
	register_sidebar(array(
	  'name' => esc_html__( 'Footer Sidebar', SH_NAME ),
	  'id' => 'footer-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown in Footer Area.', SH_NAME ),
	  'class'=>'',
	  'before_widget'=>'<li id="%1$s"  class="col-md-3 col-sm-6 widget %2$s">',
	  'after_widget'=>'</li>',
	  'before_title' => '<h5>',
	  'after_title' => '</h5>'
	));
	register_sidebar(array(
	  'name' => esc_html__( 'Blog Listing', SH_NAME ),
	  'id' => 'blog-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', SH_NAME ),
	  'class'=>'',
	  'before_widget' => '<div class="widget m0">',
	  'after_widget' => "</div>",
	  'before_title' => '<h4 class="heading">',
	  'after_title' => '</h4>',
	));
	if( !is_object( _WSH() )  )  return;
	$sidebars = sh_set(sh_set( $theme_options, 'dynamic_sidebar' ) , 'dynamic_sidebar' ); 
	foreach( array_filter((array)$sidebars) as $sidebar)
	{
		if(sh_set($sidebar , 'topcopy')) continue ;
		
		$name = sh_set( $sidebar, 'sidebar_name' );
		
		if( ! $name ) continue;
		$slug = sh_slug( $name ) ;
		
		register_sidebar( array(
			'name' => $name,
			'id' =>  $slug ,
		    'before_widget' => '<div class="widget">',
	        'after_widget' => "</div>",
	        'before_title' => '<div class="widget-title"><h3><span class="divider"></span>',
	        'after_title' => '</h3></div>',
		) );		
	}
	
	update_option('wp_registered_sidebars' , $wp_registered_sidebars) ;
}
add_action( 'widgets_init', 'sh_widget_init' );
// Update items in cart via AJAX
add_filter('add_to_cart_fragments', 'sh_woo_add_to_cart_ajax');
function sh_woo_add_to_cart_ajax( $fragments ) {
    
	global $woocommerce;
    
	
	ob_start(); ?>
	<li class="cartbutton"><a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><i class="fa fa-shopping-cart"></i><span class="bubble"><?php echo balanceTags( $woocommerce->cart->cart_contents_count )?></span></a></li>
	
	<?php $fragments['li.cartbutton'] = ob_get_clean();	
    return $fragments;
}

add_filter( 'woocommerce_enqueue_styles', '__return_false' );
if( function_exists('vc_map')) {
	vc_set_shortcodes_templates_dir( get_template_directory().'/includes/modules/shortcodes' );
	vc_disable_frontend();
	
	add_action( 'vc_before_init', '_sh_prefix_vcSetAsTheme' );
	function _sh_prefix_vcSetAsTheme() {
	    vc_set_as_theme();
	}
}
