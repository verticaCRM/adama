<?php $options = _WSH()->option();
//printr($options); 
 ?>
<header class="row" id="header2">
<div class="container">
	<div class="row">
		<div class="col-sm-5 menu">
			<nav class="navbar navbar-default navbar-static-top m0">
				<div class="row m0">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav2">
							<i class="fa fa-bars"></i> <?php esc_html_e('Navigation', SH_NAME);?>
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="mainNav2">
						<ul class="nav navbar-nav">
						
						<?php wp_nav_menu( array( 'theme_location' => 'main_menu_2', 'container_id' => 'navbar-collapse-1',

                                        'container_class'=>'navbar-collapse collapse',
                                        'menu_class'=>'nav navbar-nav navbar-right',
                                        'fallback_cb'=>false, 
                                        'items_wrap' => '%3$s', 
                                        'container'=>false, 
                                        'walker'=> new SH_Bootstrap_walker() 

                                    ) ); ?>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</div>
		<div class="col-sm-2 logo text-center">
		<?php //printr($options);
				$log_url = sh_set( $options, 'site_logo', get_template_directory_uri().'/images/logo.png' );
                $log_url = ( $log_url ) ? $log_url : get_template_directory_uri().'/images/logo.png';
				        //echo esc_url($log_url);exit;
						
                $logo_size = @getimagesize($log_url); //printr($logo_size); ?>

				<a title="<?php echo esc_attr(get_bloginfo('name')); ?>" href="<?php echo esc_url(home_url()); ?>">
					<img src="<?php echo esc_url($log_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"  width="<?php echo sh_set( $logo_size, 0); ?>" height="<?php echo sh_set( $logo_size, 1); ?>" >
				</a>
		</div>
		<div class="col-sm-5 menu2">
			<ul class="nav fright">
				<?php if( $myaccount_page = sh_set( $options, 'myaccount_page' ) ): ?>
					<li><a href="<?php echo get_permalink( $myaccount_page ); ?>"><?php esc_html_e('My Account', SH_NAME);?></a></li>
				<?php endif;?>
				<?php if( $checkout_page = sh_set( $options, 'checkout_page' ) ): ?>
					<li><a href="<?php echo get_permalink( $checkout_page ); ?>"><?php esc_html_e('Checkout', SH_NAME);?></a></li>
				<?php endif;?>
				<?php if( $wishlist_page = sh_set( $options, 'wishlist_page' ) ): ?>
					<li><a href="<?php echo get_permalink( $wishlist_page ); ?>"><i class="fa fa-heart-o"></i></a></li>
				<?php endif;?>
				<li><a data-toggle="collapse" href="#searchForm" aria-expanded="false" aria-controls="searchForm"><i class="fa fa-search"></i></a></li>
				<?php if(sh_set($options, 'shopping_cart_icon')):?>
					<?php if( function_exists( 'WC' ) ): 
                                        global $woocommerce; ?>
						<li><a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span class="badge"><?php echo balanceTags( $woocommerce->cart->cart_contents_count )?></span></a></li>
					<?php endif;?>
				<?php endif; ?>	
			</ul>
		</div>
	</div>
</div>        
<div class="collapse" id="searchForm">
	<div class="container">
		<form action="<?php echo home_url(); ?>" method="get" role="form" class="">
			<div class="input-group">
				<input type="search" name="s" placeholder="<?php esc_html_e('Search',  SH_NAME); ?>" class="form-control" value="<?php echo get_search_query(); ?>">
				<span class="input-group-addon">
					<button type="submit"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form>
	</div>
</div>
</header>