<?php $options = _WSH()->option();

global $post, $product, $post_type;
$post_id = get_the_id();
 
//$header_style = sh_set( $options, 'header_style' );
//$header_style = sh_set( $_GET, 'header_style' ) ? 'side' : 'normal';

/** Set the default values */
//$bg = sh_set( $options, 'archive_page_header_img' );
$title = sh_set( $options, 'normal_page_title' ) ;
$text = sh_set( $options, 'normal_page_header_text' );?>

<?php if( is_category() || is_tag() || is_tax( 'product_cat' ) ) {
	$meta = _WSH()->get_term_meta( '_sh_category_settings' );
	$object = get_queried_object();
	$bg = sh_set( $meta, 'header_img' );
	$title = ( sh_set( $meta, 'header_title' ) ) ? sh_set( $meta, 'header_title' ) : $object->name ;
	$text = sh_set( $meta, 'header_text' );
} else if ( is_search() ) {

	$bg = sh_set( $options, 'search_page_header_img' );
	$title = ( sh_set( $options, 'search_page_title' ) ) ? sh_set( $options, 'search_page_title' ) : get_search_query() ;
	$text = sh_set( $options, 'search_page_header_text' );

} else if( is_author() ) {
	$bg = sh_set( $options, 'author_page_header_img' );
	$title = ( sh_set( $options, 'author_page_title' ) ) ? sh_set( $options, 'author_page_title' ) : get_queried_object()->data->dispaly_name ;
	$text = sh_set( $options, 'author_page_header_text' );

} else if( is_archive('product') ) {
	if( class_exists('woocommerce') && is_shop() ) $post_id = get_option( 'woocommerce_shop_page_id' );
	$meta = _WSH()->get_meta('_sh_header_settings', $post_id ); 
	$bg = sh_set( $meta, 'bg_image' );
	$title = ( sh_set( $meta, 'header_title' ) ) ? sh_set( $meta, 'header_title' ) : get_the_title();
	$text = ( sh_set( $meta, 'header_text' ) ) ? sh_set( $meta, 'header_text' ) : 'A minimal make-up theme';
} else if( is_archive() ) {
	$bg = sh_set( $options, 'archive_page_header_img' );
	$title = ( sh_set( $options, 'archive_page_title' ) ) ? sh_set( $options, 'archive_page_title' ) : get_queried_object()->data->dispaly_name ;
	$text = sh_set( $options, 'archive_page_header_text' );
}?>

<div class="logo-wrapper">
    <h1><a href="<?php esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php if($title){echo $title;}else{wp_title('');} ?></a></h1>
    <p class="subline"><?php if($text){echo $text;}else{bloginfo('description');} ?></p>
</div>
        
<div id="normal-header" class="container-fluid">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only"><?php _e('Toggle navigation', SH_NAME);?></span>
                <span class="icon-menu-2"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
        	<?php wp_nav_menu( array( 
									'container' => false,
									'fallback_cb' => false, 
									'theme_location' => 'main_menu',
									'menu_class' => 'nav navbar-nav',
									'walker' => new SH_Bootstrap_walker()
									) ); ?>
        </div><!-- /.navbar-collapse -->
    </nav>
</div><!-- end normal header -->