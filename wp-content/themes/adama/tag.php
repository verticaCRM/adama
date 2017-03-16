<?php global $wp_query; //printr($wp_query);  
$options = _WSH()->option();
get_header(); 
$meta = _WSH()->get_term_meta();
_WSH()->page_settings = $meta; 
$layout = sh_set( $meta, 'layout', 'full' );
$sidebar = sh_set( $meta, 'sidebar', 'blog-sidebar' );
$view = sh_set( $meta, 'view', 'list' );
$view = sh_set( $_GET, 'view' ) ? sh_set( $_GET, 'view' ) : $view;
$classes = ( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) ? ' col-md-12' : ' col-lg-8 col-md-8' ;
$bg = sh_set( $meta, 'header_img' );
$title = sh_set( $meta, 'header_title' );
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
		  <ul class="row">
			
			<?php while( have_posts() ): the_post();?>

					<?php get_template_part( 'blog' ); ?>
				
			<?php endwhile; ?>
			
			<div class="text-center">
				<?php _the_pagination(); ?>
				<!-- /pagination --> 
			</div>
			
		  </ul>
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

<?php get_footer(); ?>