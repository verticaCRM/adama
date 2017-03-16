<?php $options = _WSH()->option(); ?>

<?php $boxed = sh_set( $options, 'boxed_layout' );
$topbar = sh_set( $options, 'topbar_position' );
$nobg = sh_set( $options, 'header_no' );
if( is_page() ) {
	$meta = _WSH()->get_meta();//printr($meta);
	$boxed = (sh_set( $meta, 'boxed' )) ? true : $boxed;
	$topbar = (sh_set( $meta, 'topbar' )) ? true : false;
	$nobg = sh_set( $meta, 'nobg' );
}

$header_option = sh_set($options ,'header_option');

if( $header_option && sh_set( $options, 'custom_header' ) == 'dafault' ) return;

$dark_class = ( $header_option && sh_set( $options, 'custom_header' ) !== 'default' ) ? ' dark_header' : '';
?>



	<div id="topbar" class="clearfix<?php echo esc_attr( $dark_class ); ?>">
    	<div class="container">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="social-icons">
                	<?php echo sh_get_social_icons(); ?>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="topmenu">
                	<?php if( $header_login_page = sh_set( $options, 'header_login_page' ) ): ?>
						<span class="topbar-login">
							<i class="fa fa-user"></i> 
							<a href="<?php echo get_permalink($header_login_page); ?>" title="<?php echo get_the_title( $header_login_page ); ?>">
								<?php esc_html_e('Login / Register', SH_NAME); ?>
							</a>
						</span>
                    <?php endif; ?>
					
					<?php if( function_exists( 'WC' ) ): 
						global $woocommerce; ?>
						<span class="topbar-cart">
							<i class="fa fa-shopping-cart"></i> 
							<a class="cart-contents" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>">
								<?php echo sprintf(_n('%d item ', '%d items ', $woocommerce->cart->cart_contents_count, SH_NAME), $woocommerce->cart->cart_contents_count); ?> 
								- <?php echo WC()->cart->get_cart_subtotal(); ?>
							</a>
						</span>
					<?php endif; ?>
                </div><!-- end top menu -->
            	<div class="callus">
					
					<?php if( $header_email = sh_set( $options, 'header_email' ) ): ?>
                		<span class="topbar-email"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo sanitize_email($header_email); ?>"><?php echo sanitize_email($header_email); ?></a></span>
					<?php endif; ?>
					
					<?php if( $header_phone = sh_set( $options, 'header_phone' ) ): ?>
                    	<span class="topbar-phone"><i class="fa fa-phone"></i> <?php echo balanceTags($header_phone); ?></span>
					<?php endif; ?>
                </div><!-- end callus -->
            </div><!-- end columns -->
        </div><!-- end container -->
    </div><!-- end topbar -->
