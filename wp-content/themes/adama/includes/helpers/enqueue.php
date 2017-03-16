<?php

class SH_Enqueue
{
	
	function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'sh_enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'wp_head' ) );
		add_action( 'wp_footer', array( $this, 'wp_footer' ) );
		
		// Apply filter
		add_filter('body_class', array( $this, 'custom_body_classes') );
		
		add_action( '_sh_body_id', array( $this, 'body_id' ) );
		
	}
	
	function sh_enqueue_scripts()
	{
		global $post, $wp_query;
		$options = _WSH()->option();
		
		$current_theme = wp_get_theme();
		$header_style = sh_set( $options, 'header_style' );
		//$header_style = sh_set( $_GET, 'header_style' ) ? 'side' : 'normal';
 
		$version = $current_theme->get( 'Version' );
		
		$dark_color = ( sh_set( $options, 'website_theme' ) == 'dark' ) ? true : false;
		
		$dark_color = ( sh_set( $_GET, 'color_style' ) == 'dark' ) ? true : $dark_color;
		
		$protocol = is_ssl() ? 'https' : 'http';
		$styles = array( 
						 'Roboto' => $protocol.'://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic',
 						 'Lato' => $protocol.'://fonts.googleapis.com/css?family=Lato:100,300,400,700,900',
 						 'Montserrat' => $protocol.'://fonts.googleapis.com/css?family=Montserrat:400,700',
 						 
						 'bootstrap' => 'css/bootstrap.min.css',
						 'main-theme' => 'css/main.css',
						 'main-style'	=> 'style.css',
						 'animate' => 'css/animate.css',
						 'responsive' => 'css/responsive.css',
						 'font-awesome' => 'css/font-awesome.min.css',
						 
						 'woocommerce' => ( class_exists('woocommerce') ) ? 'css/woocommerce.css' : '',
						 'custom-style'=>'css/custom.css',
						 'color_scheme' => 'css/color.php' ,
						);
		
		if( sh_set( $options, 'enable_rtl' ) ) $styles['theme_rtl'] = 'css/rtl.css';
		
		$styles = $this->custom_fonts($styles); //Load google fonts that user choose from theme options
		
		//if( $dark_color ) $styles['dark_scheme'] = 'css/dark-style.css';
							
		foreach( $styles as $name => $style )
		{
			if( !$style ) continue;
			if(strstr($style, 'http') || strstr($style, 'https') ) wp_enqueue_style( $name, $style);
			else wp_enqueue_style( $name, _WSH()->includes( $style, true ), '', $version );
		}
		
		$scripts = array( 
						  'wow-min' => 'js/wow.min.js',
						  
						  'bootstrap-select'		=> 'js/bootstrap-select.js',
						  'bootstrap-min'		=> 'js/bootstrap.min.js',
						  		  
						  'jquery-stellar'	=> 'js/jquery.stellar.js',
						  'jquery-flexslider-min' => 'js/jquery.flexslider-min.js',
						  'owl-carousel-min' => 'js/owl.carousel.min.js',
						  'jquery-sticky' => 'js/jquery.sticky.js',
						  'own-menu' => 'js/own-menu.js',
						  'jquery-mapmarker' => 'js/mapmarker.js',
						  'jquery-nouislider-min' => 'js/jquery.nouislider.min.js',
						  'print-script'	 => 'js/jquery.print.js',
						  'main-script'	 => 'js/main.js',
						  
						 );
		foreach( $scripts as $name => $js )
		{
			wp_register_script( $name, _WSH()->includes( $js, true ), '', $version, true);
		}
		
		wp_enqueue_script( array('jquery', 'wow-min', 'bootstrap-select', 'bootstrap-min', 'jquery-stellar', 'jquery-flexslider-min', 'owl-carousel-min', 'jquery-sticky', 'own-menu', 'main-script'));
		
		if( is_singular() ) wp_enqueue_script('comment-reply');
		
		if( is_single() ) {
			$format = get_post_format();
			if( $format == 'gallery' ) wp_enqueue_script( array( 'jquery-flexslider' ) );
			if( $format == 'video' || $format == 'audio' ) wp_enqueue_script( array( 'jquery-fitvids' ) );
		}
		
		if( is_singular( 'sh_portfolio' ) || $wp_query->is_posts_page || is_search() || is_tag() || is_category() || is_author() || is_archive() ) 
  		wp_enqueue_script( array('jquery-flexslider', 'owl.carousel', 'jquery-prettyphoto') );
		wp_enqueue_script( array('custom-script') );
		
		
	}
	
	function wp_head()
	{
		$opt = _WSH()->option(); ?>
		<script type="text/javascript"> if( ajaxurl === undefined ) var ajaxurl = "<?php echo esc_url(admin_url('admin-ajax.php'));?>";</script>
		<style type="text/css">
			<?php
			if( sh_set( $opt, 'body_custom_font') )
			echo sh_get_font_settings( array( 'body_font_size' => 'font-size', 'body_font_family' => 'font-family', 'body_font_style' => 'font-style', 'body_font_color' => 'color', 'body_line_height' => 'line-height' ), 'body, p {', '}' );
			
			if( sh_set( $opt, 'use_custom_font' ) ){
				echo sh_get_font_settings( array( 'h1_font_size' => 'font-size', 'h1_font_family' => 'font-family', 'h1_font_style' => 'font-style', 'h1_font_color' => 'color', 'h1_line_height' => 'line-height' ), 'h1 {', '}' );
				echo sh_get_font_settings( array( 'h2_font_size' => 'font-size', 'h2_font_family' => 'font-family', 'h2_font_style' => 'font-style', 'h2_font_color' => 'color', 'h2_line_height' => 'line-height' ), 'h2 {', '}' );
				echo sh_get_font_settings( array( 'h3_font_size' => 'font-size', 'h3_font_family' => 'font-family', 'h3_font_style' => 'font-style', 'h3_font_color' => 'color', 'h3_line_height' => 'line-height' ), 'h3 {', '}' );
				echo sh_get_font_settings( array( 'h4_font_size' => 'font-size', 'h4_font_family' => 'font-family', 'h4_font_style' => 'font-style', 'h4_font_color' => 'color', 'h4_line_height' => 'line-height' ), 'h4 {', '}' );
				echo sh_get_font_settings( array( 'h5_font_size' => 'font-size', 'h5_font_family' => 'font-family', 'h5_font_style' => 'font-style', 'h5_font_color' => 'color', 'h5_line_height' => 'line-height' ), 'h5 {', '}' );
				echo sh_get_font_settings( array( 'h6_font_size' => 'font-size', 'h6_font_family' => 'font-family', 'h6_font_style' => 'font-style', 'h6_font_color' => 'color', 'h6_line_height' => 'line-height' ), 'h6 {', '}' );
			}
			echo sh_set( $opt, 'header_css' );
			?>
		</style>
        
        <?php $color_scheme = sh_set($opt, 'custom_color_scheme', '#f4c212');
        //if(function_exists('sh_theme_color_scheme')) echo balanceTags('<style>'.sh_theme_color_scheme($color_scheme).'</style>'); ?>
        
        <?php
	}
	
	function wp_footer()
	{
		$analytics = sh_set( _WSH()->option(), 'footer_analytics');
		
		echo   balanceTags($analytics);
		
		$theme_options = _WSH()->option();
		
		if( sh_set( $theme_options, 'footer_js' ) ): ?>
			<script type="text/javascript">
                <?php echo sh_set( $theme_options, 'footer_js' );?>
            </script>
        <?php endif;
	}
	
	function custom_fonts( $styles )
	{
		$opt = _WSH()->option();
		$protocol = ( is_ssl() ) ? 'https' : 'http';
		$font = array();
		//$font_options = array('h1_font_family', 'h2_font_family', 'h3_font_family');
		
		if( sh_set( $opt, 'use_custom_font' ) ){
			
			if( $h1 = sh_set( $opt, 'h1_font_family' ) ) $font[$h1] = urlencode( $h1 ).':400,300,600,700,800';
			if( $h2 = sh_set( $opt, 'h2_font_family' ) ) $font[$h2] = urlencode( $h2 ).':400,300,600,700,800';
			if( $h3 = sh_set( $opt, 'h3_font_family' ) ) $font[$h3] = urlencode( $h3 ).':400,300,600,700,800';
		}
		
		if( sh_set( $opt, 'body_custom_font' ) ){
			if( $body = sh_set( $opt, 'body_font_family' ) ) $font[$body] = urlencode( $body ).':400,300,600,700,800';
		}
		
		if( $font ) $styles['sh_google_custom_font'] = $protocol.'://fonts.googleapis.com/css?family='.implode('|', $font);
		
		return $styles;
	}
	
	function custom_body_classes( $classes )
	{
		$options = _WSH()->option();
		
		$dark_color = ( sh_set( $options, 'website_theme' ) == 'dark' ) ? true : false;
		
		$dark_color = ( sh_set( $_GET, 'color_style' ) == 'dark' ) ? true : $dark_color;
		
		if( $dark_color ) $classes[] = 'dark-style';
	
		return $classes;
	}
	
	function body_id() 
	{
		$options = _WSH()->option();
		
		$boxed = sh_set( $options, 'boxed_layout' );
		
		$boxed_layout = ( $boxed && !$nobg ) ? ' id="boxed" ' : ''; 
		
		echo   balanceTags($boxed_layout);
	}
}
