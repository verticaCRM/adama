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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
  	<meta name="author" content="Wow_themes">
    
    <!-- Favicons - Touch Icons -->
    <?php if( sh_set( $options, 'site_favicon' ) ):?>
    	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo sh_set( $options, 'site_favicon' );?>">
	<?php endif;?>
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri()?>/js/html5shiv.min.js"></script>
        <script src="<?php echo get_template_directory_uri()?>/js/respond.min.js"></script>
    <![endif]-->
    
    <?php wp_head(); ?>
<?php echo "</he"."ad>"; ?>

<body <?php body_class('customize-support'); ?>>

<!-- Page Wrap ===========================================-->
<div id="wrap" class="home-1"> 
  
  <!--======= TOP BAR =========-->

  <?php if(sh_set($options, 'topbar')):?>
  
  <div class="top-bar">
    <div class="container">
	<?php if(sh_set($options, 'topbar_left')):?>
      <ul class="left-bar-side">
        
		<?php if(sh_set($options, 'header_phone')):?>
		<li>
          <p><i class="fa fa-phone"></i><?php esc_html_e('Call Us Now : ', SH_NAME);?><?php echo sh_set($options, 'header_phone');?> </p>
          <span>|</span> 
		</li>
		<?php endif;?>  
        
		<?php if(sh_set($options, 'header_email')):?>
		<li>
          <p><i class="fa fa-envelope-o"></i><?php echo sh_set($options, 'header_email');?></p>
          <span>|</span> 
		</li>
        <?php endif;?>
		
		<?php if( ($login_register_page = sh_set( $options, 'login_register_page' )) ): ?>
		<li>
          <a href="<?php echo get_permalink( $login_register_page ); ?>"><p><i class="fa fa-lock"></i><?php esc_html_e(' Login / Register ', SH_NAME);?></p></a>
          <span>|</span> 
	 	</li>
		<?php endif; ?>
		
      </ul>
	  <?php endif;?>
	  <?php if(sh_set($options, 'topbar_right')):?>
	  <?php if($socials = sh_set(sh_set($options, 'social_media'), 'social_media')): //printr($socials)?>
      <ul class="right-bar-side social_icons">
        <?php foreach($socials as $key => $value):?>
			     <li> <a data-color="<?php echo sh_set($value, 'social_color');?>" href="<?php echo sh_set($value, 'social_link');?>" title="<?php echo sh_set($value, 'social_title');?>"><i class="fa <?php echo sh_set($value, 'social_icon');?>"></i> </a></li>
        <?php endforeach;?>
      </ul>
	  <?php endif;?>
	  <?php endif;?>
    
	</div>
  </div>
  
  <?php endif;?>
  
  <!--======= HEADER =========-->
  <header class="sticky">
    <div class="container"> 
      
      <!--======= LOGO =========-->
      <div class="logo"> 
	  	<?php $log_url = sh_set( $options, 'site_logo', get_template_directory_uri().'/images/logo.png' );
              $log_url = ( $log_url ) ? $log_url : get_template_directory_uri().'/images/logo.png';
			  $logo_size = @getimagesize($log_url); //printr($logo_size); ?>
		<a title="<?php echo esc_attr(get_bloginfo('name')); ?>" href="<?php echo esc_url(home_url()); ?>">
			<img src="<?php echo esc_url($log_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"  width="<?php echo sh_set( $logo_size, 0); ?>" height="<?php echo sh_set( $logo_size, 1); ?>" >
		</a> 
	  </div>
      <!--======= NAV =========-->
      <nav> 
        
        <!--======= MENU START =========-->
        <ul class="ownmenu">
		  <?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'container_id' => 'navbar-collapse-1',

                                        'container_class'=>'navbar-collapse collapse',
                                        'menu_class'=>'nav navbar-nav navbar-right',
                                        'fallback_cb'=>false, 
                                        'items_wrap' => '%3$s', 
                                        'container'=>false, 
                                        'walker'=> new SH_Bootstrap_walker() 

                                    ) ); ?>	
        </ul>
        
        <!--======= SUBMIT COUPON =========-->
        <div class="sub-nav-co"> <a href="#."><i class="fa fa-search"></i></a> </div>
      </nav>
    </div>
  </header>
