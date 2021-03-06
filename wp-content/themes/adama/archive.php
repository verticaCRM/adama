<?php global $wp_query; //printr($wp_query); 
$options = _WSH()->option();
get_header(); 
$settings  = _WSH()->option(); 
$layout = sh_set( $settings, 'archive_page_layout', 'full' );
if( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) $sidebar = ''; else
$sidebar = sh_set( $settings, 'archive_page_sidebar', 'blog-sidebar' );
$view = sh_set( $settings, 'archive_page_view', 'list' );
_WSH()->page_settings = array('layout'=>$layout, 'view'=> $view, 'sidebar'=>$sidebar);
$classes = ( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) ? ' col-sm-12' : ' col-sm-9' ;
$bg = sh_set( $settings, 'archive_page_header_img' );
$title = sh_set( $settings, 'archive_page_header_title' );
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
			
			<li class="text-center">
				<?php _the_pagination(); ?>
				<!-- /pagination --> 
			</li>
			
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