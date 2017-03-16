<?php
//add_action( '_sh_after_body_start', '_sh_preloader', 5, 1 );
//add_action( '_sh_after_body_start', '_sh_sidebar_menu', 10, 1 );
//add_action( '_sh_after_body_start', '_sh_nav_and_logo', 15, 1 );

add_action( 'publish_sh_property', '_sh_publish_sh_property' );

function _WSH()
{
	return $GLOBALS['_sh_base'];
}
/** function to hook body id */
function _sh_body_id()
{
	do_action( '_sh_body_id' );
}
/** A function to fetch the categories from wordpress */
function sh_get_categories($arg = false, $by_slug = false, $show_all = true)
{
	global $wp_taxonomies;
	if( ! empty($arg['taxonomy']) && ! isset($wp_taxonomies[$arg['taxonomy']]))
	{
		//register_taxonomy( $arg['taxonomy'], 'sh_'.$arg['taxonomy']);
	}
	//printr($arg);
	
	$categories = get_terms(sh_set( $arg, 'taxonomy', 'category' ), $arg);
	$cats = array();
	if( $show_all ) $cats[] = esc_html__( 'All Categories', SH_NAME );
	
	if( !is_wp_error( $categories ) ) {
	foreach($categories as $category)
	{
		if( $by_slug ) $cats[$category->slug] = $category->name;
		else $cats[$category->term_id] = $category->name;
	}
	}
	return $cats;
}
if( !function_exists( 'sh_slug' ) )
{
	function sh_slug( $string )
	{
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
}
function sh_get_sidebars($multi = false)
{
	global $wp_registered_sidebars;
	$sidebars = !($wp_registered_sidebars) ? get_option('wp_registered_sidebars') : $wp_registered_sidebars;
	if( $multi ) $data[] = array('value'=>'', 'label' => 'No Sidebar');
	else $data = array('' => esc_html__('No Sidebar', SH_NAME));
	foreach( (array)$sidebars as $sidebar)
	{
		if( $multi ) $data[] = array( 'value'=> sh_set($sidebar, 'id'), 'label' => sh_set( $sidebar, 'name') );
		else $data[sh_set($sidebar, 'id')] = sh_set($sidebar, 'name');
	}
	return $data;
}
if ( ! function_exists('character_limiter'))
{
	function character_limiter($str, $n = 500, $end_char = '&#8230;', $allowed_tags = false)
	{
		if($allowed_tags) $str = strip_tags($str, $allowed_tags);
		if (strlen($str) < $n)	return $str;
		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));
		if (strlen($str) <= $n) return $str;
		$out = "";
		foreach (explode(' ', trim($str)) as $val)
		{
			$out .= $val.' ';
			
			if (strlen($out) >= $n)
			{
				$out = trim($out);
				return ( strlen($out ) == strlen($str)) ? $out : $out.$end_char;
			}		
		}
	}
}
function sh_get_social_icons()
{
	$options = _WSH()->option('social_media');//printr($options);
	$output = '';
	
	$count = 0;
	
	if( sh_set( $options, 'social_media' ) && is_array( sh_set( $options, 'social_media' ) ) )
	{
		$social_media = sh_set( $options, 'social_media' );
		$total = count( $social_media );
		foreach( sh_set( $options, 'social_media' ) as $social_icon ){
			
			if($total <= $count) continue;
			
			if( isset( $social_icon['tocopy' ] ) ) continue;
			
			$title = sh_set( $social_icon, 'title');
			$link = sh_set( $social_icon, 'social_link');
			$icon = sh_set( $social_icon, 'social_icon');
			$color = sh_set( $social_icon, 'hover_color' );
			
			if(!$link && !$icon) continue;
			$output .= '
			<li data-color="'.esc_attr($color).'">
				<a data-toggle="tooltip" data-placement="bottom" title="'.esc_attr( $title ).'" href="'.esc_url( $link ).'"><i class="fa '.$icon.'"></i></a>
			</li>'."\n";
			
			$count++;
		}
	}
	
	
	return $output;
}

function sh_get_posts_array( $post_type = 'post', $flip = false )
{
	global $wpdb;
	$res = $wpdb->get_results($wpdb->prepare( "SELECT `ID`, `post_title` FROM `" .$wpdb->prefix. "posts` WHERE `post_type` = %s AND `post_status` = 'publish' ", $post_type ), ARRAY_A );
	
	$return = array();
	foreach( $res as $k => $r) {
		if( $flip ) {
			if( isset( $return[sh_set($r, 'post_title')] ) ) $return[sh_set($r, 'post_title').$k] = sh_set($r, 'ID');
			else $return[sh_set($r, 'post_title')] = sh_set( $r, 'ID' );
		}
		else $return[sh_set($r, 'ID')] = sh_set($r, 'post_title');
	}
	return $return;
}

function get_the_breadcrumb()
{
	global $wp_query;
	$queried_object = get_queried_object();
	
	$breadcrumb = '';
	$delimiter = ' ';
	$before = '<li>';
	$after = '</li>';
	if ( ! is_home())
	{
		$breadcrumb .= '<li><a href="'.home_url().'">'.esc_html__('Home', SH_NAME).'</a></li>';
		
		/** If category or single post */
		if(is_category())
		{
			$cat_obj = $wp_query->get_queried_object();
			$this_category = get_category( $cat_obj->term_id );
	
			if ( $this_category->parent != 0 ) {
				$parent_category = get_category( $this_category->parent );
				$breadcrumb .= get_category_parents($parent_category, TRUE, $delimiter );
			}
			
			$breadcrumb .= '<li><a href="'.get_category_link(get_query_var('cat')).'">'.single_cat_title('', FALSE).'</a></li>';
		}
		elseif(is_tax())
		{
			$breadcrumb .= '<li><a href="'.get_term_link($queried_object).'">'.$queried_object->name.'</a></li>';
		}
		elseif(is_page()) /** If WP pages */
		{
			global $post;
			if($post->post_parent)
			{
                $anc = get_post_ancestors($post->ID);
                foreach($anc as $ancestor)
				{
                    $breadcrumb .= '<li><a href="'.get_permalink($ancestor).'">'.get_the_title($ancestor).'</a></li>';
                }
				$breadcrumb .= '<li>'.get_the_title($post->ID).'</li>';
				
            }else $breadcrumb .= '<li>'.get_the_title().'</li>';
		}
		elseif (is_singular())
		{
			if($category = wp_get_object_terms(get_the_ID(), get_taxonomies()))
			{
				if( !is_wp_error($category) )
				{
					$breadcrumb .= '<li><a href="'.get_term_link(sh_set($category, '0')).'">'.sh_set( sh_set($category, '0'), 'name').'</a></li>';
					$breadcrumb .= '<li>'.get_the_title().'</li>';
					
				} else $breadcrumb .= '<li>'.get_the_title().'</li>';
			}else{
				$breadcrumb .= '<li>'.get_the_title().'</li>';
			}
		}
		elseif(is_tag()) $breadcrumb .= '<li><a href="'.get_term_link($queried_object).'">'.single_tag_title('', FALSE).'</a></li>'; /**If tag template*/
		elseif(is_day()) $breadcrumb .= '<li><a href="">'.esc_html__('Archive for ', SH_NAME).get_the_time('F jS, Y').'</a></li>'; /** If daily Archives */
		elseif(is_month()) $breadcrumb .= '<li><a href="' .get_month_link(get_the_time('Y'), get_the_time('m')) .'">'.esc_html__('Archive for ', SH_NAME).get_the_time('F, Y').'</a></li>'; /** If montly Archives */
		elseif(is_year()) $breadcrumb .= '<li><a href="'.get_year_link(get_the_time('Y')).'">'.esc_html__('Archive for ', SH_NAME).get_the_time('Y').'</a></li>'; /** If year Archives */
		elseif(is_author()) $breadcrumb .= '<li><a href="'. esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) .'">'.esc_html__('Archive for ', SH_NAME).get_the_author().'</a></li>'; /** If author Archives */
		elseif(is_search()) $breadcrumb .= '<li>'.esc_html__('Search Results for ', SH_NAME).get_search_query().'</li>'; /** if search template */
		elseif(is_404()) $breadcrumb .= '<li>'.__('404 - Not Found', SH_NAME).'</li>'; /** if search template */
		elseif ( is_post_type_archive('product') )
		{
			
			$shop_page_id = woocommerce_get_page_id( 'shop' );
			if( get_option('page_on_front') !== $shop_page_id  )
			{
				$shop_page    = get_post( $shop_page_id );
				
				$_name = woocommerce_get_page_id( 'shop' ) ? get_the_title( woocommerce_get_page_id( 'shop' ) ) : '';
		
				if ( ! $_name ) {
					$product_post_type = get_post_type_object( 'product' );
					$_name = $product_post_type->labels->singular_name;
				}
		
				if ( is_search() ) {
		
					$breadcrumb .= $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $delimiter . esc_html__( 'Search results for &ldquo;', 'woocommerce' ) . get_search_query() . '&rdquo;' . $after;
		
				} elseif ( is_paged() ) {
		
					$breadcrumb .= $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $after;
		
				} else {
		
					$breadcrumb .= $before . $_name . $after;
		
				}
			}
	
		}
		else $breadcrumb .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>'; /** Default value */
	}
	return ''.$breadcrumb.'';
}
function sh_register_user( $data )
{
	//printr($data);
	$user_name = sh_set( $data, 'user_login' );
	$user_email = sh_set( $data, 'user_email' );
	$user_pass = sh_set( $data, 'user_password' );
	$policy = sh_set( $data, 'policy_agreed');
	
	$user_id = username_exists( $user_name );
	$message = '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>'.esc_html__('You must agreed the policy', SH_NAME).'</h5></div>';;
	if( !$policy ) $message = '';
	if ( !$user_id && email_exists($user_email) == false ) {
		if( $policy ){
			$random_password = ( $user_pass ) ? $user_pass : wp_generate_password( $length=12, $include_standard_special_chars=false );
			$user_id = wp_create_user( $user_name, $random_password, $user_email );
			if ( is_wp_error($user_id) && is_array( $user_id->get_error_messages() ) )
			{
				foreach($user_id->get_error_messages() as $message)	$message .= '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>'.$message.'</h5></div>';
			}
			else $message = '<div class="alert-success" style="margin-bottom:10px;padding:10px"><h5>'.esc_html__('Registration Successful - An email is sent', SH_NAME).'</h5></div>';
		}
		
	} else {
		$message .= '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>'.esc_html__('Username or email already exists.  Password inherited.', SH_NAME).'</h5></div>';
	}
	return $message;
}
function sh_list_comments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment; ?>
  <!-- comment -->
  	<!-- Item -->
    <li class="media">
		
		<div class="comment-inner">
			<?php $email = sh_set( $comment, 'comment_author_email' );?>
			
			<div class="media-left"> 
				<a href="#"> 
					<?php if( $email ): ?>
						<img class="media-object" src="<?php echo get_gravatar_url( $email ); ?>" alt="image"> 
					<?php else: ?>
						<img class="img-circle media-object" src="http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=70" />
			<?php endif;?>
				</a> 
			</div>
			
			<div class="media-body">
			  <h6 class="media-heading"><?php echo get_comment_author_link(); ?><span> <?php echo get_comment_date(); ?></span></h6>
			  <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => esc_html__('Reply', SH_NAME)))) ?>
			  <?php comment_text(); /** print our comment text */ ?>
			</div>
		</div>
	<?php
	//endif;
}
/**
 * returns the formatted form of the comments
 *
 * @param	array	$args		an array of arguments to be filtered
 * @param	int		$post_id	if form is called within the loop then post_id is optional
 *
 * @return	string	Return the comment form
 */
function sh_comment_form( $args = array(), $post_id = null, $review = false )
{
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id = $post_id;
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<li class="col-sm-4"><input id="name" placeholder="'. esc_html__( 'NAME', SH_NAME ).'" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></li>',
		'email'  => '<li class="col-sm-4"><input id="comment_email" placeholder="'. esc_html__( 'EMAIL', SH_NAME ).'" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></li>',
		'subject'  => '<li class="col-sm-4"><input id="subject" placeholder="'. esc_html__( 'SUBJECT', SH_NAME ).'" class="form-control" name="website" type="text" size="30" /></li>',								
	);
	$required_text = sprintf( ' ' . __('Required fields are marked %s', SH_NAME), '<span class="required">*</span>' );
	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	 */
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<li class="col-sm-12"><label><textarea id="comments" placeholder="'. esc_html__( 'MESSAGE', SH_NAME ).'" class="form-control" name="comment" cols="45" rows="3" aria-required="true"></textarea></label></li>',
		'must_log_in'          => '<li class="col-md-12 col-sm-12">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', SH_NAME ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</li>',
		'logged_in_as'         => '<li class="col-md-12 col-sm-12">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', SH_NAME ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</li>',
		'comment_notes_before' => '<li class="col-md-12 col-sm-12">' . esc_html__( 'Your email address will not be published.', SH_NAME ) . ( $req ? $required_text : '' ) . '</li>',
		'comment_notes_after'  => '',
		'id_form'              => 'comments_form',
		'id_submit'            => 'submit',
		'title_reply'          => '',
		'title_reply_to'       => esc_html__( 'Leave a Reply to %s', SH_NAME ),
		'cancel_reply_link'    => esc_html__( 'Cancel reply', SH_NAME ),
		'label_submit'         => esc_html__( 'Add Comment ', SH_NAME ),
		'format'               => 'xhtml',
	);
	/**
	 * Filter the comment form default arguments.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php
			/**
			 * Fires before the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_before' );
			?>
			<div id="respond" class="comments row">
				<div class="widget-title">
					<h3><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				</div>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo   balanceTags($args['must_log_in']); ?>
					<?php
					/**
					 * Fires after the HTML-formatted 'must log in after' message in the comment form.
					 *
					 * @since 3.0.0
					 */
					do_action( 'comment_form_must_log_in_after' );
					?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="form-horizontal"<?php echo   balanceTags($html5) ? ' novalidate' : ''; ?>>
						<ul class="clearfix">
						<?php
						/**
						 * Fires at the top of the comment form, inside the <form> tag.
						 *
						 * @since 3.0.0
						 */
						do_action( 'comment_form_top' );
						?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php
							/**
							 * Filter the 'logged in' message for the comment form for display.
							 *
							 * @since 3.0.0
							 *
							 * @param string $args['logged_in_as'] The logged-in-as HTML-formatted message.
							 * @param array  $commenter            An array containing the comment author's username, email, and URL.
							 * @param string $user_identity        If the commenter is a registered user, the display name, blank otherwise.
							 */
							echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
							?>
							<?php
							/**
							 * Fires after the is_user_logged_in() check in the comment form.
							 *
							 * @since 3.0.0
							 *
							 * @param array  $commenter     An array containing the comment author's username, email, and URL.
							 * @param string $user_identity If the commenter is a registered user, the display name, blank otherwise.
							 */
							do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
							?>
						<?php else : ?>
							<?php echo   balanceTags($args['comment_notes_before']); ?>
							<?php
							/**
							 * Fires before the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								/**
								 * Filter a comment form field for display.
								 *
								 * The dynamic portion of the filter hook, $name, refers to the name
								 * of the comment form field. Such as 'author', 'email', or 'url'.
								 *
								 * @since 3.0.0
								 *
								 * @param string $field The HTML-formatted output of the comment form field.
								 */
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							/**
							 * Fires after the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php
						/**
						 * Filter the content of the comment textarea field for display.
						 *
						 * @since 3.0.0
						 *
						 * @param string $args['comment_field'] The content of the comment textarea field.
						 */
						echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
						?>
						<?php echo balanceTags($args['comment_notes_after']); ?>
                        	<li class="col-sm-12">
								<button id="<?php echo esc_attr( $args['id_submit'] ); ?>" class="btn main-btn hvr-sweep-to-right"><i class="fa fa-angle-right"></i> <?php echo esc_attr( $args['label_submit'] ); ?> </button>
						    	<?php comment_id_fields( $post_id ); ?>
						    </li>
							
						<?php
						/**
						 * Fires at the bottom of the comment form, inside the closing </form> tag.
						 *
						 * @since 1.5.2
						 *
						 * @param int $post_id The post ID.
						 */
						do_action( 'comment_form', $post_id );
						?>
						</ul>
					</form>
					
				<?php endif; ?>
			</div><!-- #respond -->
			<?php
			/**
			 * Fires after the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_after' );
		else :
			/**
			 * Fires after the comment form if comments are closed.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_comments_closed' );
		endif;
}
function sh_blog_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'sh_blog_excerpt_more');
function _the_pagination($args = array(), $echo = 1)
{
	
	global $wp_query;
	
	$default =  array('base' => str_replace( 99999, '%#%', esc_url( get_pagenum_link( 99999 ) ) ), 'format' => '?paged=%#%', 'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages, 'next_text' => '&raquo;', 'prev_text' => '&laquo;', 'type'=>'list');
						
	$args = wp_parse_args($args, $default);			
	
	//$pagination = '<div class="text-center pagination">'.paginate_links($args).'</div>';
	$pagination = str_replace("<ul class='page-numbers'", '<ul class="pagination"', paginate_links($args) );
	
	if(paginate_links(array_merge(array('type'=>'array'),$args)))
	{
		if($echo) echo balanceTags($pagination);
		return $pagination;
	}
}
add_action( '_sh_blog_post_image', 'sh_get_post_format_output' );
function sh_get_post_format_output($meta = array() )
{
	global $post;
	
	//if( ! $settings ) return;
	$meta = ( $meta ) ? $meta : _WSH()->get_meta();
	$format = get_post_format();
	
	$format = get_post_format();
	//$size = (sh_set( $settings, 'size' ) ) ? sh_set( $settings, 'size' ) : '1750x1143';
	
	$output = '';
	switch( $format )
	{
		case 'standard':
		case 'image': ?>
        	
            <div class="media-element entry">
				<?php the_post_thumbnail('1000x600', array('class' => 'img-responsive'));?>
                <div class="magnifier"></div>
            </div><!-- end media -->
			
		<?php break;
		case 'gallery': ?>
			<div class="media-element">
  
    	
				<?php $thumbnails = sh_set( $meta, 'sh_gallery_imgs' );
                if( $thumbnails ) : ?>
                <div class="flexslider flex-direction-nav-on-top">
                      
                    <ul class="slides entry">
                        <?php foreach( $thumbnails as $thumbnail ): ?>
                      
                            <?php $att_id = sh_set($thumbnail, 'gallery_image');?>
            
                            <?php if( esc_url( $att_id ) ): ?>
                            <li><img class="img-responsive" src="<?php echo esc_url( $att_id ); ?>" alt="<?php the_title_attribute(); ?>" /></li>
                            <?php endif; ?>
                      
                        <?php endforeach; ?>
                    </ul>
              
                </div><!-- end flexslider -->
                <?php endif; ?>
            </div><!-- end media -->
		<?php break;
		case 'video': ?>
			<div class="media-element">
               <?php echo sh_set( $meta, 'video' ); ?>
            </div><!-- end media -->
		<?php break;
		case 'audio': ?>
        	<div class="media-element">
               <?php echo sh_set( $meta, 'audio' ); ?>
            </div><!-- end media -->
        <?php break;
		case 'quote':
		case 'link': ?>
			<blockquote class="custom"><?php echo sh_set($meta, 'quote'); ?><small><?php the_author(); ?></small></blockquote>
		<?php break;
		default: ?>
			<div class="media-element entry">
				<?php the_post_thumbnail('1000x600', array('class' => 'img-responsive'));?>
                <div class="magnifier"></div>
            </div><!-- end media -->
		<?php break;
	}
	
	//echo  balanceTags($output);
}
function sh_get_font_settings( $FontSettings = array(), $StyleBefore = '', $StyleAfter = '' )
{
	$i = 1;
	$settings = _WSH()->option();
	$Style = '';
	foreach( $FontSettings as $k => $v )
	{
		if( $i == 1 || $i == 5 )
		{
			$Style .= ( sh_set( $settings, $k )  ) ? $v.':'.sh_set( $settings, $k ).'px!important;': '';
		}
		else
		{
			$Style .= ( sh_set( $settings, $k  )  ) ? $v.':'.sh_set( $settings, $k ).'!important;': '';
		}
		$i++;
	}
	return ( !empty( $Style ) ) ? $StyleBefore.$Style.$StyleAfter: '';
}
function sh_register_dynamic_sidebar()
{
	$theme_options = get_option( SH_NAME.'_theme_options');
	$sidebars = sh_set( sh_set( $theme_options, 'dynamic_sidebar' ), 'dynamic_sidebar' );
	if( $sidebars && is_array( $sidebars ) )
	{
		foreach( $sidebars as $sidebar ){
			
			if( isset( $sidebar['tocopy'] ) ) continue;
			
			register_sidebar( array(
				'name' => $sidebar['sidebar_name'],
				'id' => sh_slug( $sidebar['sidebar_name'] ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => "</div>",
				'before_title' => '<h4 class="title"><span>',
				'after_title' => '</span></h4>',
			) );
		}
	}
}
function get_gravatar_url( $email, $width = 80 ) {
    $hash = md5( strtolower( trim ( $email ) ) );
    return 'http://gravatar.com/avatar/' . $hash.'?s='.$width;
}
function _sh_star_rating( $dis = false )
{
	$ip = $_SERVER['REMOTE_ADDR'];
	
	$meta = get_post_meta( get_the_id(), '_download_rating', true );
	
	$count = count( $meta ) ? count( $meta ) : 1;
	
	$titles = array( esc_html__('Poor', SH_NAME), esc_html__('Satisfactory', SH_NAME), esc_html__('Good', SH_NAME), esc_html__('Better', SH_NAME), esc_html__('Awesome', SH_NAME) );
	
	$evg = array_sum((array)$meta) / $count;
	
	if( $dis )
	{
		foreach( array_reverse( range( 0, 4 ) ) as $rang )
		{
			$checked = ( ( $rang + 1 ) <= round( $evg ) ) ? 'fa-star' : 'fa-star-o';
			echo '<i class="fa '.$checked.'" title="'.$titles[$rang].'" data-post-id="'.get_the_ID().'"/></i>'."\n";
		}
	}
	else
	{
		$disabled = isset( $meta[$ip] ) ? ' disabled="disabled"' : '';
		echo '<div class="clearfix center">'."\n";
		foreach( range( 0, 4 ) as $rang )
		{
			$checked = ( ( $rang + 1 ) == round( $evg ) ) ? ' checked="checked"' : '';
			echo '<input class="download-star" type="radio" name="download-2-rating-1"'.$disabled.$checked.' value="'.( $rang + 1 ).'" title="'.$titles[$rang].'" data-post-id="'.get_the_ID().'"/>'."\n";
		}
		echo '</div>'."\n";
		printf(esc_html__('Average Rating %s', SH_NAME), $evg );
	}
}
function _sh_trim( $text, $len, $more = null )
{
	$text = strip_shortcodes( $text );
	
	$text = apply_filters( 'the_content', $text );
	$text = str_replace(']]>', ']]&gt;', $text);
	
	$excerpt_length = apply_filters( 'excerpt_length', $len );
	
	$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
	
	$excerpt_more = ( $more ) ? $more : ' ...';
	
	$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	
	return $text;
	
}
function _sh_get_page_by_template( $tmpl, $index = 0 )
{
	$pages = get_posts(array(
        'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'meta_value' => $tmpl
	));
	
	if( $pages ){
		return $pages[$index];
	}
	
	return false;
}
function _sh_preloader($options)
{
	/** Preloader if enabled from theme options */
	if( sh_set( $options, 'preloader' ) ): ?>
		<div class="animationload">
			<div class="loader"><?php esc_html_e('Loading...', SH_NAME); ?></div>
		</div>
	<?php endif;
}
function _sh_sidebar_menu($options)
{
	include( _WSH()->includes('includes/modules/sidebar_menu.php') );
	
}
function _sh_nav_and_logo( $options )
{
	$custom_header = sh_set( $options, 'custom_header' );
	$custom_header = sh_set( $_GET, 'custom_header' ) ? 'center_logo' : $custom_header;
	if( $custom_header == 'center_logo' )
		include( _WSH()->includes('includes/modules/nav_style1.php') );
	else
		include( _WSH()->includes('includes/modules/nav_default.php') );
}
function sh_header_class( $class = null )
{
	$options = _WSH()->option();
	$header_option = sh_set( $options, 'header_option' );
	$custom_header = sh_set( $options, 'custom_header' );
	$header_class = '';
	
	$header_class .= ( $header_option && $custom_header == 'center_logo' ) ? 'header_center affix-top ' : '';
	$header_class .= ( $header_option && $custom_header == 'dafault' ) ? 'dark_header affix-top ' : '';
	
	if( sh_set( $options, 'sticky_menu' ) ) $header_class .= 'afffix ';
	if( $class ) $header_class .= $class;
	if( $header_class ) return ' class="'.$header_class.'" ';
	
	return false;
}
function sh_social_media_array(){
	$themeoptions = _WSH()->option();
	$arr = array();
	if($socials = sh_set(sh_set($themeoptions, 'social_media'), 'social_media')){
	foreach($socials as $k => $social){
		if(sh_set( $social, 'tocopy' )) continue;
		$arr[$k] = sh_set( $social, 'title' ); 
	}}
	return $arr;
}

function _sh_publish_sh_property( $post_id, $post = object )
{

	$post_id = ( $post_id ) ? $post_id : $post->ID;
	$fields = array('property_status', 'price', 'property_type', 'bedrooms', 'bathrooms', 'address');
	
	$property_field = sh_set( $_POST, '_sh_sh_property_settings' );
	
	foreach( $fields as $field ) {
		$value = sh_set( $property_field, $field );

		update_post_meta( $post_id, '_sh_'.$field, $value );
	}
	

}
