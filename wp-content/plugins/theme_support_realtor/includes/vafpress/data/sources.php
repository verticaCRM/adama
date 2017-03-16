<?php



/**

 * Here is the place to put your own defined function that serve as

 * datasource to field with multiple options.

 */





function vp_get_loader_images()

{

	$dir = get_template_directory().'/includes/thirdparty/ajax-loader/loaders';

	$return = array();

	if ($handle = opendir($dir)) {

		/* This is the correct way to loop over the directory. */

		while (false !== ($entry = readdir($handle))) {

			if( $entry != '.' && $entry != '..' ){

				$return[] = array('value' => $entry, 'label' => $entry);

			}

		}

	}

	return $return;

}



function vp_get_categories()

{

	$wp_cat = get_categories(array('hide_empty' => 0 ));

	$result = array();

	foreach ($wp_cat as $cat)

	{

		$result[] = array('value' => $cat->cat_ID, 'label' => $cat->name);

	}

	return $result;

}





function vp_get_products_categories()

{

	$wp_cat = get_terms( 'product_cat', array('hide_empty' => 0 ));//printr($wp_cat);

	//$wp_cat = get_option( '_sh_product_category_terms' );

	$result = array();

	foreach ($wp_cat as $cat)

	{

		$result[] = array('value' => $cat->term_id, 'label' => $cat->name);

	}

	return $result;

}



function vp_get_users()

{

	$wp_users = VP_WP_User::get_users();

	$result = array();

	foreach ($wp_users as $user)

	{

		$result[] = array('value' => $user['id'], 'label' => $user['display_name']);

	}

	return $result;

}



function vp_get_posts()

{

	$wp_posts = get_posts(array(

		'posts_per_page' => -1,

	));



	$result = array();

	foreach ($wp_posts as $post)

	{

		$result[] = array('value' => $post->ID, 'label' => $post->post_title);

	}

	return $result;

}
function vp_get_services()

{

	$wp_posts = get_posts(array(

		'posts_per_page' => -1,
		'post_type' => 'sh_services',

	));



	$result = array();

	foreach ($wp_posts as $post)

	{

		$result[] = array('value' => $post->ID, 'label' => $post->post_title);

	}

	return $result;

}



function vp_get_pages()

{

	$wp_pages = get_pages();



	$result = array();

	foreach ($wp_pages as $page)

	{

		$result[] = array('value' => $page->ID, 'label' => $page->post_title);

	}

	return $result;

}



function vp_get_tags()

{

	$wp_tags = get_tags(array('hide_empty' => 0));

	$result = array();

	foreach ($wp_tags as $tag)

	{

		$result[] = array('value' => $tag->term_id, 'label' => $tag->name);

	}

	return $result;

}



function vp_get_posts_array( $post_type = 'post' )

{

	global $wpdb;



	$res = $wpdb->get_results( "SELECT `ID`, `post_title` FROM `" .$wpdb->prefix. "posts` WHERE `post_type` = '$post_type' AND `post_status` = 'publish' " );

	

	$return = array();

	foreach( $res as $k => $r) {

		

		$return[] = array('value' => $r->ID, 'label' => $r->post_title);

		

	}



	return $return;

}



function vp_get_roles()

{

	$result         = array();

	$editable_roles = VP_WP_User::get_editable_roles();



	foreach ($editable_roles as $key => $role)

	{

		$result[] = array('value' => $key, 'label' => $role['name']);

	}



	return $result;

}



function vp_get_gwf_family()

{

	$fonts = file_get_contents(dirname(__FILE__) . '/gwf.json');

	$fonts = json_decode($fonts);



	$fonts = array_keys(get_object_vars($fonts));



	foreach ($fonts as $font)

	{

		$result[] = array('value' => $font, 'label' => $font);

	}



	return $result;

}



VP_Security::instance()->whitelist_function('vp_get_gwf_weight');



function vp_get_gwf_weight($face)

{

	if(empty($face))

		return array();

	

	$fonts   = file_get_contents(dirname(__FILE__) . '/gwf.json');

	$fonts   = json_decode($fonts);

	$weights = $fonts->{$face}->weights;



	foreach ($weights as $weight)

	{

		$result[] = array('value' => $weight, 'label' => $weight);

	}



	return $result;

}



VP_Security::instance()->whitelist_function('vp_get_gwf_style');



function vp_get_gwf_style($face)

{

	if(empty($face))

		return array();

	

	$fonts   = file_get_contents(dirname(__FILE__) . '/gwf.json');

	$fonts   = json_decode($fonts);

	$styles = $fonts->{$face}->styles;



	foreach ($styles as $style)

	{

		$result[] = array('value' => $style, 'label' => $style);

	}



	return $result;

}



function vp_get_social_medias() {

	$socmeds = array(

		array('value' => 'fa-adn', 'label' => 'ADM'),

		array('value' => 'fa-android', 'label' => 'Android'),

		array('value' => 'fa-apple', 'label' => 'Apple'),

		array('value' => 'fa-bitbucket', 'label' => 'Bitbucket'),

		array('value' => 'fa-bitbucket-square', 'label' => 'Bitbucket Square'),

		array('value' => 'fa-btc', 'label' => 'Btc'),

		array('value' => 'fa-css3', 'label' => 'Css3'),

		array('value' => 'fa-dribbble', 'label' => 'Dribbble'),

		array('value' => 'fa-dropbox', 'label' => 'Dropbox'),

		array('value' => 'fa-facebook', 'label' => 'Facebook'),

		array('value' => 'fa-facebook-square', 'label' => 'Facebook square'),

		array('value' => 'fa-flickr', 'label' => 'Flickr'),

		array('value' => 'fa-foursquare', 'label' => 'Foursquare'),

		array('value' => 'fa-github', 'label' => 'Github'),

		array('value' => 'fa-github-alt', 'label' => 'Github alt'),

		array('value' => 'fa-github-square', 'label' => 'Github square'),

		array('value' => 'fa-gittip', 'label' => 'Gittip'),

		array('value' => 'fa-google-plus', 'label' => 'Google Plus'),

		array('value' => 'fa-google-plus-square', 'label' => 'Google Plus Square'),

		array('value' => 'fa-html5', 'label' => 'Html5'),

		array('value' => 'fa-instagram', 'label' => 'Instagram'),

		array('value' => 'fa-linkedin', 'label' => 'Linkedin'),

		array('value' => 'fa-linkedin-square', 'label' => 'Linkedin Square'),

		array('value' => 'fa-linux', 'label' => 'Linux'),

		array('value' => 'fa-maxcdn', 'label' => 'Maxcdn'),

		array('value' => 'fa-pagelines', 'label' => 'Pagelines'),

		array('value' => 'fa-pinterest', 'label' => 'Pinterest'),

		array('value' => 'fa-pinterest-square', 'label' => 'Pinterest square'),

		array('value' => 'fa-renren', 'label' => 'Renren'),

		array('value' => 'fa-skype', 'label' => 'Skype'),

		array('value' => 'fa-stack-exchange', 'label' => 'Stack exchange'),

		array('value' => 'fa-stack-overflow', 'label' => 'Stack overflow'),

		array('value' => 'fa-trello', 'label' => 'Trello'),

		array('value' => 'fa-tumblr', 'label' => 'Tumblr'),

		array('value' => 'fa-tumblr-square', 'label' => 'Tumblr square'),

		array('value' => 'fa-twitter', 'label' => 'Twitter'),

		array('value' => 'fa-twitter-square', 'label' => 'Twitter square'),

		array('value' => 'fa-vimeo-square', 'label' => 'Vimeo square'),

		array('value' => 'fa-vk', 'label' => 'Vk'),

		array('value' => 'fa-weibo', 'label' => 'Weibo'),

		array('value' => 'fa-windows', 'label' => 'Windows'),

		array('value' => 'fa-xing', 'label' => 'Xing'),

		array('value' => 'fa-xing-square', 'label' => 'Xing square'),

		array('value' => 'fa-youtube', 'label' => 'Youtube'),

		array('value' => 'fa-youtube-play', 'label' => 'Youtube play'),

		array('value' => 'fa-youtube-square', 'label' => 'Youtube square'),

		array('value' => 'fa-yelp', 'label' => 'Yelp'),

		array('value' => 'fa-blogger', 'label' => 'Blogger'),

		array('value' => 'fa-deviantart', 'label' => 'Deviantart'),

	);



	return $socmeds;

}



function vp_get_fontawesome_icons()

{

	// scrape list of icons from fontawesome css

	if( false === ( $icons  = get_transient( 'vp_fontawesome_icons' ) ) )

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

		set_transient( 'vp_fontawesome_icons', $icons, 60 * 60 * 24 );

	}



	return $icons;

}



VP_Security::instance()->whitelist_function('vp_dep_boolean');

function vp_dep_boolean($value = null)

{

	$args   = func_get_args();

	$result = true;

	foreach ($args as $val)

	{

		$result = ($result and !empty($val));

	}

	return $result;

}

VP_Security::instance()->whitelist_function('sh_get_sidebars_2');

function sh_get_sidebars_2()

{

	global $wp_registered_sidebars;

	$sidebars = !($wp_registered_sidebars) ? get_option('wp_registered_sidebars') : $wp_registered_sidebars;

	$data =  array(array('value'=> '', 'label'=> __('No Sidebar', SH_NAME)));

	foreach( (array)$sidebars as $sidebar)

	{

		$data[] = array('value'=> sh_set($sidebar, 'id'), 'label'=>sh_set($sidebar, 'name')) ;

	}

	return $data;

}



/*------------------------------------------------*/



VP_Security::instance()->whitelist_function('vp_dep_style1');

VP_Security::instance()->whitelist_function('vp_dep_style2');

VP_Security::instance()->whitelist_function('vp_dep_style3');

function vp_dep_style1($value)

{

	if( $value == 'normal' ) return true;

	

	return false;

}

function vp_dep_style2($value)

{

	if( $value == 'side' ) return true;

	

	return false;

}

function vp_dep_style3($value)

{

	if( $value == 'grid' ) return true;

	

	return false;

}





/**

 * EOF

 */