<?php
global $wp_query; //printr($wp_query);
$settings  = _WSH()->option();
get_header(); 
if( $wp_query->is_posts_page ) {
    $queried_object = get_queried_object();
	$meta = _WSH()->get_meta('_sh_layout_settings', $queried_object->ID);//printr($meta);
	$meta1 = _WSH()->get_meta('_sh_header_settings', $queried_object->ID);//printr($meta1);
	$layout = sh_set( $meta, 'layout', 'right' );
	$page_sidebar = sh_set( $meta, 'sidebar', 'default-sidebar' );
	$bg = sh_set( $meta1, 'bg_image' );
	$title = sh_set( $meta1, 'header_title', sh_set($queried_object, 'post_title') );
} else {
	$layout = (sh_set($_GET, 'layout')) ? sh_set($_GET, 'layout') : sh_set($settings, 'archive_page_layout');
	$layout = $layout ? $layout : 'right';
	$page_sidebar = sh_set($settings, 'archive_page_sidebar', 'default-sidebar');
	$bg = sh_set( $settings, 'archive_page_header_img' );
	$title = sh_set( $settings, 'archive_page_header_title', 'Blog' );
	
}
$sidebar = $page_sidebar ? $page_sidebar : 'default-sidebar';
$classes = ( $layout && $layout === 'full') ? 'col-md-12' : 'col-md-8';
?>
<!--======= BANNER =========-->
<div class="sub-banner" <?php if($bg):?>style="background-image: url('<?php echo esc_url($bg); ?>');"<?php endif;?>>
<div class="overlay">
  <div class="container">
	<h1><?php if($title) echo  balanceTags( $title ); else wp_title('');?></h1>
	<ol class="breadcrumb">
	  <li class="pull-left"><?php if($title) echo  balanceTags( $title ); else wp_title('');?></li>
	  <?php echo get_the_breadcrumb();?>	
	</ol>
  </div>
</div>
</div>

<!--======= PROPERTIES DETAIL PAGE =========-->
<section class="properti-detsil">
<div class="container">
  <div class="row"> 
	
	<?php if( $layout == 'left' && is_active_sidebar( $sidebar ) ): ?>

		<div class="col-sm-3 side-bar">
				<?php dynamic_sidebar( $sidebar ); ?>
		</div>

	<?php endif; ?>
	<!-- end sidebar -->
	
	<!--======= LEFT BAR =========-->
	<div class="<?php echo esc_attr($classes);?>"> 
	  
	  <!--======= CLIENTS FEEDBACK =========-->
	  
	  <div class="blog-page">
		<section class="blog no-padding">
		  <div class="row">
			
			<?php while( have_posts() ): the_post();?>

					<?php get_template_part( 'blog' ); ?>
				
			<?php endwhile; ?>
			
			<div class="text-center">
				<?php _the_pagination(); ?>
				<!-- /pagination --> 
			</div>
			
		  </div>
		</section>
	  </div>
	</div>
	
	<!--======= SIDE BAR =========-->
	<?php if( $layout == 'right' && is_active_sidebar( $sidebar ) ): ?>
	
		<div class="col-sm-3 side-bar">
				<?php dynamic_sidebar( $sidebar ); ?>
		</div>
	
	<?php endif; ?>
	<!-- end sidebar -->
  
  </div>
</div>
</section>

<?php
get_footer();
?>