<?php
$options = _WSH()->option();
get_header(); 
//$settings  = sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_page_meta', true) , 'sh_page_options') , 0);
//$meta = _WSH()->get_meta('_sh_layout_settings');
//$layout = sh_set( $meta, 'layout', 'full' );
//$sidebar = sh_set( $meta, 'sidebar', 'product-sidebar' );
//$classes = ( !$layout || $layout == 'full' ) ? ' col-lg-12 col-md-12' : ' col-lg-9 col-md-9';
?>

<!--======= BANNER =========-->
<div class="sub-banner">
<div class="overlay">
  <div class="container">
	<h1><?php esc_html_e('404', SH_NAME);?></h1>
	<ol class="breadcrumb">
	  <li class="pull-left"><?php esc_html_e('404', SH_NAME);?></li>
	  <?php echo get_the_breadcrumb();?>	
	</ol>
  </div>
</div>
</div>

<!--======= 404 PAGES =========-->
  <section class="error-page">
    <div class="container">
      <div class="row">
        <div class="col-sm-7 text-center"> <span class="not-found font-montserrat"><?php esc_html_e('page not found', SH_NAME);?></span> <span class="head-404 font-montserrat"><?php esc_html_e('404', SH_NAME);?></span>
          <h4><?php esc_html_e('Page doesn’t exist or other error occured. Go to our ', SH_NAME);?><a href="#." class="font-montserrat"><?php esc_html_e('HOMEPAGE', SH_NAME);?></a><?php esc_html_e(' or go back to ', SH_NAME);?><a href="#." class="font-montserrat"><?php esc_html_e('PREVIOUS PAGE', SH_NAME);?></a></h4>
        </div>
        
        <!--======= IMAGE =========-->
        <div class="col-sm-5"> <img class="img-responsive" src="<?php echo get_template_directory_uri();?>/images/404-img.png" alt=""> </div>
      </div>
    </div>
  </section>
<?php get_footer(); ?>