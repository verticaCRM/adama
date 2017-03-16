<?php

include_once( 'helpers/functions.php' );

class SH_Base extends SH_Functions
{
	public $path = '';
	public $url = '';
	public $inc = '';
	public $inc_url = '';
	public $page_settings;
	
	
	function __construct()
	{
		$this->path = get_template_directory().'/';
		$this->url = get_template_directory_uri().'/';
		$this->inc = $this->path.'includes/';
		$this->inc_url = $this->url.'includes/';
		
		parent::__construct();
	}
	
	function __set_attrib( $attr = array() )
	{
		$res = ' ';
		foreach( $attr as $k => $v )
		{
			$res .= $k.'="'.$v.'" ';
		}
		
		return $res;
	}
	
	function option( $key = '' )
	{
		$theme_options = get_option( SH_NAME.'_theme_options' );
		
		if( $key ) return sh_set( $theme_options, $key );
		
		return $theme_options;
	}
	
	function includes( $path = '', $url = false )
	{
		$child = get_stylesheet_directory().'/';
		if( file_exists( $child.$path ) ) {
			if( $url ) return get_stylesheet_directory_uri().'/'.$path;
			else return $child.$path;
		}
		
		if( $url ) return get_template_directory_uri().'/'.$path;
		else return $this->path.$path;
	}
	
	function get_meta( $key = '', $id = '' )
	{
		global $post, $post_type;
		$post_type = $post->post_type;//( $post_type ) ? $post_type : $post->post_type;
		
		$id = ( $id ) ? $id : sh_set( $post, 'ID' );
		
		$key = ( $key ) ? $key : '_sh_'.$post_type.'_settings';

		$meta = get_post_meta( $id, $key, true );
		
		return ( $meta ) ? $meta : false;
	}
	
	function set_meta_key( $post_type )
	{
		if( ! $post_type ) return;
		
		return '_sh_'.$post_type.'_settings';
		
	}
	
	function get_term_meta( $key = '' )
	{
		$object = get_queried_object();
		
		//$id = ( $id ) ? $id : sh_set( $post, 'ID' );
		$key = ( $key ) ? $key.$object->term_id : '_sh_'.$object->taxonomy.'_settings'.$object->term_id;

		$meta = get_option( $key );
		
		return ( $meta ) ? $meta : false;
	}
	
	function set_term_key( $post_type )
	{
		if( ! $post_type ) return;
		
		return '_sh_'.$post_type.'_settings';
		
	}
	
	function page_template( $tpl )
	{
		$page = get_pages(array('meta_key' => '_wp_page_template','meta_value' => $tpl));
		if($page) return current( (array)$page);
		else return false;
	}
	
	function user_extra( $extras = array() )
	{
		$this->extras = $extras;
		
		add_filter('user_contactmethods', array( $this, 'newuserfilter' ) );

		
	}

	function newuserfilter($old)
	{
		$array = $this->extras;
		
		$new = array_merge($array, $old);
		return $new;
	}
	
	function first_last( $current, $cols )
	{
		$current++;
		if( $current == 1 ) return ' first';
		else if( (( $current ) % $cols ) == 0 ) return ' last';
		else if( ( ( $current - 1 ) % $cols ) == 0 ) return ' first';
	}

}

$GLOBALS['_sh_base'] = new SH_Base;







