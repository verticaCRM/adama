<?php
if( !function_exists('_WSH') ) {
	function _WSH()
	{
		return $GLOBALS['_sh_base'];
	}
}
function sh_font_awesome( $code = false )
{
	$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
	$subject = @file_get_contents(get_template_directory().'/includes/vafpress/public/css/vendor/font-awesome.css');
	if( !$subject ) return array();
	
	preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
	$icons = array();
	
	$icons[0] = __('No Icon', SH_NAME);
	
	
	foreach($matches as $match){
		$value = str_replace( 'icon-', '', $match[1] );
		$newcode = $match[1];//str_replace('fa-', '', $match[1]);
		
		if( $code ) $icons[$match[1]] = stripslashes($match[2]);
		else $icons[$newcode] = ucwords(str_replace('fa-', ' ', $newcode));//$match[2];
	}
	
	return $icons;
}
add_filter( 'less_vars', '_sh_less_vars', 10, 2 );
function _sh_less_vars( $vars, $handle ) {
    // $handle is a reference to the handle used with wp_enqueue_style()
    $vars[ 'color' ] = '#000000';
    return $vars;
}
if( !function_exists( 'sh_theme_color_scheme' ) )
{
	function sh_theme_color_scheme( $color = '' )
	{
		
		
		$dir = SH_TH_ROOT;
		include_once($dir.'/includes/thirdparty/lessc.inc.php');
		
		if(!$color) $color = _WSH()->option('custom_color_scheme');
		
		if( ! $color ) return;	
		
		$less = new lessc;
	
		$less->setVariables(array(
		  "color" => $color,
		));
		
		// create a new cache object, and compile
		$cache = $less->cachedCompile( _WSH()->includes("/css/color.less" ) );
		
		return $cache['compiled'];
		file_put_contents( _WSH()->includes('/css/colors.css'), $cache["compiled"]);
		
	}
}
function _sh_get_attachment_id_from_src($image_src) {
	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id = $wpdb->get_var($query);
	return $id;
}
function _sh_generate_salt( $str, $decode = false )
{
	$salt = false;
	
	if( $decode ) {
		$salt_decode = base64_encode(md5('example@example.com'));
		$decoded = base64_decode(str_replace($salt_decode, '', $str));
		$salt = str_replace('anybodyhome', '', $decoded);
	}
	else {
		$salt = base64_encode(md5('example@example.com')).base64_encode('anybodyhome'.$str);
	}
	
	return $salt;
}
function sh_get_fontawesome_icons()
{
	// scrape list of icons from fontawesome css
	if( false === ( $icons  = get_transient( 'sh_fontawesome_icons' ) ) )
	{
		//$pattern = '/\.(icon-(?:\w+(?:-)?)+):before\s*{\s*content/';
		$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$subject = file_get_contents(VP_DIR . '/public/css/vendor/font-awesome.min.css');
		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
		$icons = array();
		foreach($matches as $match)
		{
		    $icons[] = array('value' => 'fa '.$match[1], 'label' => $match[1]);
		}
		set_transient( 'sh_fontawesome_icons', $icons, 60 * 60 * 24 );
	}
	return $icons;
}
function sh_vc_content_decode($content){
	return urldecode(base64_decode($content));
}