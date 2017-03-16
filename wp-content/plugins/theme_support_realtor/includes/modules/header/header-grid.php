<?php $options = _WSH()->option();
//printr($options);
global $post, $product, $post_type;
$post_id = get_the_id();
 
//$header_style = sh_set( $options, 'header_style' );
//$header_style = sh_set( $_GET, 'header_style' ) ? 'side' : 'normal';

/** Set the default values */
$bg = sh_set( $options, 'grid_page_header_img' );
$title = sh_set( $options, 'grid_page_title' ) ;
$text = sh_set( $options, 'grid_page_header_text' );?>

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

}
else if( is_archive() ) {
	$bg = sh_set( $options, 'archive_page_header_img' );
	$title = ( sh_set( $options, 'archive_page_title' ) ) ? sh_set( $options, 'archive_page_title' ) : get_queried_object()->data->dispaly_name ;
	$text = sh_set( $options, 'archive_page_header_text' );
} else if( is_page() ) {
	if( class_exists('woocommerce') && is_shop() ) $post_id = get_option( 'woocommerce_shop_page_id' );
	$meta = _WSH()->get_meta('_sh_header_settings', $post_id ); 
	$bg = sh_set( $meta, 'bg_image' );
	$title = ( sh_set( $meta, 'header_title' ) ) ? sh_set( $meta, 'header_title' ) : get_the_title();
	$text = ( sh_set( $meta, 'header_text' ) ) ? sh_set( $meta, 'header_text' ) : 'A minimal make-up theme';
}else if( is_singular() ){
	$meta = _WSH()->get_meta('_sh_header_settings', $post_id ); 
	$bg = sh_set( $meta, 'bg_image' );
	$title = ( sh_set( $meta, 'header_title' ) ) ? sh_set( $meta, 'header_title' ) : get_the_title();
	$text = sh_set( $meta, 'header_text' );
}
?>

<div id="container" class="container intro-effect-grid clearfix">
    <header class="header-wrapper">
        <ul class="grid">
        <?php 
			$products_num = sh_set($options, 'products_num');
			$sort = sh_set($options, 'sort');
			$order = sh_set($options, 'order');
			$product_category = sh_set($options, 'product_category');
			$query_args = array('post_type' => 'product' , 'showposts' => $products_num ,'orderby' => $order , 'order' => $sort );
			if( $product_category ) $query_args['tax_query'] = array(array('taxonomy' => 'product_cat','field' => 'id','terms' => $product_category));
			$query = new WP_Query($query_args) ; ?>
			<?php while( $query->have_posts() ): $query->the_post(); 
				$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720,405 ), false, '' );
				$product = new WC_Product( get_the_ID() );
				$price = $product->price;
			?>
            	<li style="background-image: url(<?php echo $src[0];?>)"><h2><a href="<?php the_permalink();?>"><?php the_title();?> <small><?php echo $product->get_price_html()?></small></a></h2></li>
        <?php endwhile;?>
        <?php wp_reset_query();?>
        </ul>
        <div class="bg-img">
        	<?php if($bg):?>
            	<img src="<?php echo $bg;?>" class="img-responsive" alt="">
            <?php else:?>
            	<img src="<?php echo get_template_directory_uri();?>/images/shop_bg.jpg" class="img-responsive" alt="">
            <?php endif;?>    
        </div>
            <div class="title">
            	
				<?php wp_nav_menu( array( 
									'container' => false,
									'fallback_cb' => false, 
									'theme_location' => 'main_menu',
									'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'walker' => new SH_Bootstrap_walker()
									) );
									?>
                
            <h1><a href="<?php esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php if($title){echo $title;}else{wp_title('');} ?></a></h1>
            <p class="subline"><?php if($text){echo $text;}else{bloginfo('description');} ?></p>
        </div>
    </header>
    <button class="trigger" data-info="<?php _e('Click to read', SH_NAME);?>"><span><?php _e('Trigger', SH_NAME);?></span></button>
</div>
<hr>
