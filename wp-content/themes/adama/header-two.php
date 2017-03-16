<?php $options = _WSH()->option();
//printr($options); 
 ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><!--<![endif]-->
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<meta name="author" content="Wow_themes">
    
    <!-- Favicons - Touch Icons -->
    <?php if( sh_set( $options, 'site_favicon' ) ):?>
    	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo sh_set( $options, 'site_favicon' );?>">
	<?php else:?> 
    	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-60x60.png">
    	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-72x72.png">
    	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-76x76.png">
    	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-114x114.png">
    	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-120x120.png">
    	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-144x144.png">
    	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-152x152.png">
    	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-180x180.png">
    	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/favicon/android-icon-192x192.png">
    	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-32x32.png">
    	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-96x96.png">
    	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-16x16.png">
	<?php endif;?>
	
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri()?>/js/html5shiv.min.js"></script>
        <script src="<?php echo get_template_directory_uri()?>/js/respond.min.js"></script>
    <![endif]-->
    
    <?php wp_head(); ?>
</head>

<body <?php body_class('customize-support'); ?>>

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
                                        //'walker'=> new SH_Bootstrap_walker() 

                                    ) ); ?>
							
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Home</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="index.html">Home Default</a></li>
									<li><a href="index3.html">Home 2</a></li>
									<li><a href="index2.html">Home 3</a></li>
									<li><a href="index4.html">Home 4</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pages</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="about.html">About</a></li>
									<li><a href="services.html">Services</a></li>
									<li><a href="shortcodes.html">Shortcodes</a></li>
									<li><a href="blog.html">Blog</a></li>
									<li><a href="single-post.html">Single Post</a></li>
									<li><a href="404.html">404</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Product</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="product.html">Product</a></li>
									<li><a href="product2.html">Product 2</a></li>
									<li><a href="single-product.html">Single Product</a></li>
									<li><a href="catalog.html">Catalog</a></li>
								</ul>
							</li>
							<li><a href="contact.html">contact</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</div>
		<div class="col-sm-2 logo text-center">
			<a href="index2.html"><img src="images/logo2.png" alt=""></a>
		</div>
		<div class="col-sm-5 menu2">
			<ul class="nav fright">
				<li><a href="#">My Account</a></li>
				<li><a href="checkout.html">Checkout</a></li>
				<li><a href="#"><i class="fa fa-heart-o"></i></a></li>
				<li><a data-toggle="collapse" href="#searchForm" aria-expanded="false" aria-controls="searchForm"><i class="fa fa-search"></i></a></li>
				<li><a href="cart.html"><span class="badge">2</span></a></li>
			</ul>
		</div>
	</div>
</div>        
<div class="collapse" id="searchForm">
	<div class="container">
		<form action="#" method="get" role="form" class="">
			<div class="input-group">
				<input type="search" class="form-control" placeholder="Search">
				<span class="input-group-addon">
					<i class="fa fa-search"></i>
				</span>
			</div>
		</form>
	</div>
</div>
</header> <!--Header-->

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
						<?php if( $wishlist_page = sh_set( $options, 'wishlist_page' ) ): ?>
							<li><a href="<?php echo get_permalink( $wishlist_page ); ?>"><i class="fa fa-heart"></i> <?php esc_html_e('Wishlist ', SH_NAME);?>(3)</a></li>
						<?php endif; ?>
						<?php if( $compare_page = sh_set( $options, 'compare_page' ) ): ?>
							<li><a href="<?php echo get_permalink( $compare_page ); ?>"><i class="fa fa-exchange"></i> <?php esc_html_e('Compare ', SH_NAME);?> (2)</a></li>
						<?php endif; ?>	
					</ul>
				</div>
				<?php if(sh_set($options, 'shopping_cart_icon')):?>
				
				<div class="fleft cartCount">                        
					<div class="cartCountInner row m0">
						<span class="badge">2</span>
					</div>
				</div>
				
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
</header> <!--Header-->	