<?php

class SH_Seo
{
	
	private $options = '' ;
	private $meta_info = '' ;
	private $posttype = '';
	
	function __construct()
	{
		global $wp_query, $post_type, $post ;
		
		if(is_admin()) return ;
		
		add_action( 'wp_title', array( $this, 'title' ) );
		add_action( 'wp_head', array( $this, 'head' ), 1 );
		$this->posttype =  $post_type ;
		$this->options = _WSH()->option();
				
	}
	
	/**
	 * Hooked with wp_title
	 */
	function title( $title )
	{
		global $wp_query;

		$meta_title = $title;

		if( is_singular() && !is_front_page() ) $meta_title = $this->single_title( $title ); // if the single post template.
		else if( is_tax() || is_category() || is_tag() ) $meta_title = $this->tax_title( $title );
		else if( is_home() || is_front_page() ) $meta_title = $this->home_title( $title );
		else if( is_archive() ) $meta_title = $this->archive_title( $title );

		return $meta_title;
	}
	
	function head() 
	{
		global $wp_query;

		echo '	<meta name="generator" content="Wow-Themes.com" />'."\n";

		if( is_singular() && !is_front_page() ) $this->single_meta();
		elseif( is_tax() || is_category() || is_tag() ) $this->tax_meta();
		elseif( is_home() || is_front_page() ) $this->home_meta();
		else $this->archive_meta();
	}
	
	function single_title( $title )
	{
		$obj = get_queried_object();
		$this->meta_info = get_post_meta( get_the_id(), '_sh_seo_settings', true );
		$old = ($title) ? $title : get_bloginfo( 'name' );
		
		extract( (array)$this->meta_info, EXTR_OVERWRITE );
		
		if( !isset( $seo_status ) || !$seo_status ) return $old;
		
		if( $title ) return $title;
		else return $old;
		
	}
	
	function tax_title( $title )
	{
		$object = get_queried_object();
		$this->meta_info = get_option( '_sh_tax_seo_settings'.$object->term_id );
		$old = $title;
		
		extract( (array)$this->meta_info, EXTR_OVERWRITE );
		
		if( !isset( $seo_status ) || !$seo_status ) return $old;
		
		if( $title ) return $title;
		else return $old;
	}
	
	function home_title( $title )
	{
		$def = array('_enable_seo'=>0, '_seo_home_meta_title'=>'', '_seo_home_meta_description' => '', '_seo_home_meta_keywords' => '');
		$theme_options = _WSH()->option();

		$atts = shortcode_atts( $def, $theme_options );

		$old = ($title) ? $title : get_bloginfo( 'name' );
		
		extract( (array)$atts, EXTR_OVERWRITE );
		
		if( !isset( $_enable_seo ) || !$_enable_seo ) return $old;
		
		if( $_seo_home_meta_title ) return $_seo_home_meta_title;
		else return $old;
	}
	
	function archive_title( $title )
	{
		$def = array('_enable_seo'=>0, '_seo_archive_meta_title'=>'', '_seo_archive_meta_description' => '', '_seo_archive_meta_keywords' => '');
		$theme_options = _WSH()->option();

		$atts = shortcode_atts( $def, $theme_options );

		$old = ($title) ? $title : get_bloginfo( 'name' );
		
		extract( (array)$atts, EXTR_OVERWRITE );
		
		if( !isset( $_enable_seo ) || !$_enable_seo ) return $old;
		
		if( $_seo_archive_meta_title ) return $_seo_archive_meta_title;
		else return $old;
	}
	
	function single_meta()
	{

		extract( (array)$this->meta_info, EXTR_OVERWRITE );

		if( !isset( $seo_status ) || !$seo_status ) return '';
		
		if( isset( $description ) ) echo '	<meta name="description" content="'.$description.'" />'."\n";
		if( isset( $keywords ) ) echo '	<meta name="keywords" content="'.$keywords.'" />'."\n";
		
		echo '<meta name="author" content="'.get_the_author_meta('display_name', sh_set( get_queried_object(), 'post_author')).'" />'."\n";

	}
	
	function tax_meta()
	{
		extract( (array)$this->meta_info, EXTR_OVERWRITE );

		if( !isset( $seo_status ) || !$seo_status ) return '';
		
		if( isset( $description ) ) echo '	<meta name="description" content="'.$description.'" />'."\n";
		if( isset( $keywords ) ) echo '	<meta name="keywords" content="'.$keywords.'" />'."\n";
		

	}
	
	function home_meta()
	{
		
		$def = array('_enable_seo'=>0, '_seo_home_meta_title'=>'', '_seo_home_meta_description' => '', '_seo_home_meta_keywords' => '');
		$theme_options = _WSH()->option();

		$atts = shortcode_atts( $def, $theme_options );
		
		extract( (array)$atts, EXTR_OVERWRITE );

		if( !isset( $_enable_seo ) || !$_enable_seo ) return '';
		
		if( isset( $_seo_home_meta_description ) ) echo '	<meta name="description" content="'.$_seo_home_meta_description.'" />'."\n";
		if( isset( $_seo_home_meta_keywords ) ) echo '	<meta name="keywords" content="'.$_seo_home_meta_keywords.'" />'."\n";
	}
	
	function archive_meta()
	{
		
		$def = array('_enable_seo'=>0, '_seo_archive_meta_title'=>'', '_seo_archive_meta_description' => '', '_seo_archive_meta_keywords' => '');
		$theme_options = _WSH()->option();

		$atts = shortcode_atts( $def, $theme_options );
		
		extract( (array)$atts, EXTR_OVERWRITE );

		if( !isset( $_enable_seo ) || !$_enable_seo ) return '';
		
		if( isset( $_seo_archive_meta_description ) ) echo '	<meta name="description" content="'.$_seo_archive_meta_description.'" />'."\n";
		if( isset( $_seo_archive_meta_keywords ) ) echo '	<meta name="keywords" content="'.$_seo_archive_meta_keywords.'" />'."\n";
	}
	
}