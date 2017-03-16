<?php /* Template Name: Wishlist */
get_header(); 
wp_enqueue_script(array( 'jquery-modernizr', 'jquery-glasscase', 'main_script'));
?>
<?php global $current_user, $post;
get_currentuserinfo();
$meta1 = _WSH()->get_meta('_sh_header_settings');
$meta = get_user_meta( $current_user->ID, '_ja_product_wishlist', true );//printr($meta);
$meta = array_filter( (array)$meta );
$meta_settings = _WSH()->get_meta('_sh_layout_settings');
$layout = sh_set( $meta_settings, 'layout', 'full' );
$sidebar = sh_set( $meta_settings, 'sidebar', 'page-sidebar' );
$classes = ( $layout == 'full' ) ? ' col-lg-12 col-md-12' : ' col-lg-9 col-md-9'; ?>
<?php $header_bg_image = sh_set( $meta1, 'bg_image' ) ? ' style=background-image:url('.$meta1['bg_image'].');' : ''; ?>
<section id="breadcrumbRow" class="row">
	<h2 <?php if($header_bg_image):?>style="background-image: url('<?php echo esc_url($header_bg_image); ?>');"<?php endif;?>><?php if(sh_set($meta1, 'header_title')) echo sh_set($meta1, 'header_title'); else echo wp_title('');?></h2>
	<div class="row pageTitle m0">
		<div class="container">
			<h4 class="fleft"><?php if(sh_set($meta1, 'header_title')) echo sh_set($meta1, 'header_title'); else echo wp_title('');?></h4>
			<div class="fright">
			    <?php echo get_the_breadcrumb(); ?>
        	</div>
		</div>
	</div>
</section>

<section class="white-wrapper clearfix padding-top padding-bottom">
            <div class="container">
                <div class="row">
			<?php if( $layout == 'left' ): ?>
	
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="sidebar">        
				
					<?php dynamic_sidebar( $sidebar ); ?>
				
				</div>
	
			<?php endif; ?>
        
			<div id="content" class="shop_wrapper<?php echo esc_attr($classes); ?> col-sm-12 col-xs-12 woocommerce">
				
				<?php while( have_posts() ): the_post(); ?>
					<?php the_content();?>
				<?php endwhile;?>
				
				<?php if( is_user_logged_in() ): ?>
						   
					<div class="single-page">
						<table class="cart_table table table-hover">
							
							<thead style="text-align:center;">
								<tr>
									<th><?php esc_html_e('PRODUCT', SH_NAME); ?></th>
									<th><?php esc_html_e('PRICE', SH_NAME); ?></th>
									<th><?php esc_html_e('ACTION', SH_NAME); ?></th>
                                    <th><?php esc_html_e('DELETE', SH_NAME); ?></th>
								</tr>
							</thead>
							
							<?php
							foreach( (array)$meta as $met ): $post = get_post( $met );//printr($post);
								$product = new WC_Product( $post ); //printr(get_product( $post ))?>
								<tbody>
									<tr>
										<td>
											<?php echo get_the_post_thumbnail( $met, array(65, 65), array('class'=>'img-responsive alignleft', 'width'=>65) ); ?>
		
		
											<a class="cart_title" href="<?php echo get_permalink( $met ); ?>" title="<?php echo esc_attr(get_the_title( $met )); ?>"><?php echo get_the_title( $met ); ?></a>
										</td>
										<td><?php echo balanceTags($product->get_price_html()); ?></td>
										<td><?php woocommerce_template_loop_add_to_cart(); ?></td>
										<td class="wishlist_delete">
											<a class="remove" rel="product_del_wishlist" data-id="<?php echo esc_attr($met); ?>" href="javascript:;"><?php esc_html_e('Delete', SH_NAME); ?></a>
										</td>
									</tr>
								</tbody>
							<?php endforeach; ?>
							
							
						</table>
					</div>
				<?php else: ?>
				
					<?php $acc_page = get_option('user_account_url'); ?>
					<h2><?php printf(esc_html__('To view this page sign in at <a href="%s" title="Account Page">Account Page</a>', SH_NAME), $acc_page); ?></h2>
				<?php endif; ?>
			
			</div>
        
			<?php if( $layout == 'right' ): ?>
	
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="sidebar">        
				
					<?php dynamic_sidebar( $sidebar ); ?>
				
				</div>
	
			<?php endif; ?>
			
		</div>
    
    </div>
        
</section>
<?php get_footer(); ?>