<?php $options = _WSH()->option();
//printr($options); 
global $current_user;
get_currentuserinfo();?>

<header class="row" id="header">
<?php if(sh_set($options, 'topbarstatus')):?>
<div class="row m0 top_menus">
	<div class="container">
		<div class="row">
		<?php if(sh_set($options, 'topbar_left')):?>
			<ul class="nav nav-pills fleft">
				<?php wp_nav_menu( array( 'theme_location' => 'top_left_menu', 'container_id' => 'navbar-collapse-1',

                                        'container_class'=>'navbar-collapse collapse',
                                        'menu_class'=>'nav navbar-nav navbar-right',
                                        'fallback_cb'=>false, 
                                        'items_wrap' => '%3$s', 
                                        'container'=>false, 
                                        //'walker'=> new SH_Bootstrap_walker() 

                                    ) ); ?>
			</ul>
			<?php endif;?>
			<?php if(sh_set($options, 'topbar_right')):?>
			<ul class="nav nav-pills fright">
				<?php wp_nav_menu( array( 'theme_location' => 'top_right_menu', 'container_id' => 'navbar-collapse-1',

                                        'container_class'=>'navbar-collapse collapse',
                                        'menu_class'=>'nav navbar-nav navbar-right',
                                        'fallback_cb'=>false, 
                                        'items_wrap' => '%3$s', 
                                        'container'=>false, 
                                        //'walker'=> new SH_Bootstrap_walker() 

                                    ) ); ?>
			</ul>
			<?php endif;?>
		</div>
	</div>
</div>
<?php endif;?>
<div class="row m0 logo_line">
	<div class="container">
		<div class="row">
			<div class="col-sm-5 logo">
				<?php //printr($options);
				$log_url = sh_set( $options, 'site_logo', get_template_directory_uri().'/images/logo.png' );
                $log_url = ( $log_url ) ? $log_url : get_template_directory_uri().'/images/logo.png';
				        //echo esc_url($log_url);exit;
						
                $logo_size = @getimagesize($log_url); //printr($logo_size); ?>

				<a title="<?php echo esc_attr(get_bloginfo('name')); ?>" href="<?php echo esc_url(home_url()); ?>" class="logo_a">
					<img src="<?php echo esc_url($log_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"  width="<?php echo sh_set( $logo_size, 0); ?>" height="<?php echo sh_set( $logo_size, 1); ?>" >
				</a>
			</div>
			<div class="col-sm-7 searchSec">
				<?php if(sh_set($options, 'searchbar')):?>
				<div class="fleft searchForm">
					<form action="<?php echo home_url();?>" method="get">
						<div class="input-group">
							<input type="hidden" name="post_type" value="product" id="search_">
							<input type="search" name="s" class="form-control" placeholder="Search Products">
							<input type="hidden" name="product_cat" value="chairs" id="search_product_cat">
							<div class="input-group-btn searchFilters">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<span id="searchFilterValue"><?php esc_html_e('All Categories', SH_NAME);?></span> <i class="fa fa-angle-down"></i>
								</button>
								
								<?php if($categories = get_terms( 'product_cat', 'orderby=count&hide_empty=1' )): //printr($categories);?>
								
								<ul class="dropdown-menu dropdown-menu-right" role="menu" id="_search_terms">
										<li><a href="#all">All Categories</a></li>
										<?php foreach($categories as $value):?>
											<li><a href="javascript:;" data-id="<?php echo esc_attr($value->slug);?>"><?php echo balanceTags($value->name);?></a></li>
										<?php endforeach;?>
								</ul>
								
								<?php endif;?>
							</div><!-- /btn-group -->
							<span class="input-group-btn searchIco">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div><!-- /input-group -->
					</form>
				</div>
				<?php endif;?>
				<div class="fleft wishlistCompare">
					<ul class="nav">
						<?php if( ($wishlist_page = sh_set( $options, 'wishlist_page' )) && is_user_logged_in() ): 
							$meta = (array)get_user_meta( $current_user->ID, '_ja_product_wishlist', true ); //printr($meta);?>
							<li><a href="<?php echo get_permalink( $wishlist_page ); ?>"><i class="fa fa-heart"></i> <?php esc_html_e('Wishlist ', SH_NAME);?>(<?php echo esc_attr(count(array_filter($meta))); ?>)</a></li>
						<?php endif; ?>
						<?php if( ($compare_page = sh_set( $options, 'compare_page' )) && is_user_logged_in() ): 
							$meta = (array)get_user_meta( $current_user->ID, '_ja_product_comparelist', true );?>
							<li><a href="<?php echo get_permalink( $compare_page ); ?>"><i class="fa fa-exchange"></i> <?php esc_html_e('Compare ', SH_NAME);?> (<?php echo esc_attr(count(array_filter($meta))); ?>)</a></li>
						<?php endif; ?>	
					</ul>
				</div>
				<?php if(sh_set($options, 'shopping_cart_icon')):?>
				
				<?php if( function_exists( 'WC' ) ): 
                      global $woocommerce; ?>
				<div class="fleft cartCount">                        
					<div class="cartCountInner row m0">
						<span class="badge"><?php echo balanceTags( $woocommerce->cart->cart_contents_count )?></span>
					</div>
				</div>
				<?php endif;?>
				
				<?php endif;?>
			
			</div>
		</div>
	</div>
</div>
<nav class="navbar navbar-default m0 navbar-static-top">
	<div class="container-fluid container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
				<i class="fa fa-bars"></i> Navigation
			</button>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="mainNav">
			<ul class="nav navbar-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'container_id' => 'navbar-collapse-1',

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
<div class="row topFeatures m0">
	<div class="container">
		<ul class="nav nav-justified text-center">
		<?php if($sorted_services = sh_set($options, 'sorting_services')): //printr($sorted_services);?>
			<?php foreach($sorted_services as $value):
				$meta = get_post_meta($value, '_sh_sh_services_settings', true);//_WSH()->get_meta( '_sh_sh_services_settings', $value );
				//printr($meta);
				$img_dim = @getimagesize(sh_set( $meta, 'service_image' ) ); 
				$img_dimen = ( $img_dim ) ? ' width="'.$img_dim[0].'" height="'.$img_dim[1].'"' : '';?>
				<li><img <?php echo balanceTags($img_dimen); ?> src="<?php echo esc_url( sh_set( $meta, 'service_image') ); ?>" alt="<?php echo esc_attr(get_the_title( $value )); ?>"><?php echo get_the_title( $value ); ?></li>
			<?php endforeach;?>
		<?php endif;?>
		</ul>
	</div>
</div>
</header>