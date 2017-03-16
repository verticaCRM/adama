<?php $options = _WSH()->option();
get_header(); 
$settings  = sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_page_meta', true) , 'sh_page_options') , 0);
$meta = _WSH()->get_meta('_sh_layout_settings');
$meta1 = _WSH()->get_meta('_sh_header_settings');
$meta2 = _WSH()->get_meta();
//printr($meta); 
_WSH()->page_settings = $meta;
$layout = sh_set( $meta, 'layout', 'full' );
if( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) $sidebar = ''; else
$sidebar = sh_set( $meta, 'sidebar', 'blog-sidebar' );
$classes = ( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) ? ' col-md-12 col-sm-12 col-xs-12' : ' col-md-9 col-sm-9 col-xs-12';
$bg = sh_set( $meta1, 'bg_image' );
$title = sh_set( $meta1, 'header_title' );
/** Update the post views counter */
_WSH()->post_views( true );
?>
<!--======= BANNER =========-->
<div class="sub-banner" <?php if($bg):?>style="background-image: url('<?php echo esc_url($bg); ?>');"<?php endif;?>>
<div class="overlay">
  <div class="container">
	<h1><?php if($title) echo  balanceTags( $title ); else echo 'Blog';?></h1>
	<ol class="breadcrumb">
	  <li class="pull-left"><?php if($title) echo  balanceTags( $title ); else echo 'Blog';?></li>
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
	  
	  <?php while( have_posts() ): the_post(); 
					$post_meta = _WSH()->get_meta();
	  ?>	
	  
	  <div class="single-post"> 
		<!--======= CLIENTS FEEDBACK =========-->
		
		<div class="blog-page">
		  <section class="blog no-padding">
			<ul class="row">
			  <li class="col-sm-12 single_item">
				<div class="b-inner"> 
				<?php the_post_thumbnail('1140x475', array('class' => 'img-responsive'));?>
				  <div class="b-details"> 
					
					<!--======= TITTLE =========-->
					<div class="bottom-sec"> <span><i class="fa fa-calendar"></i><?php echo get_the_date('M d, Y');?></span> <a class="font-montserrat" href="<?php the_permalink();?>"><?php the_title();?></a> </div>
				  </div>
				</div>
				
				<!--======= ADMIN INFO =========-->
				<div class="post-admin"> 
				
				<?php echo get_avatar(get_the_author_meta( 'ID' ), 54 ); ?>
				  <h6><?php the_author();?></h6>
				  <div class="pull-right margin-t-20"> <span><i class="fa fa-comment-o"></i><?php comments_number();?></span> | <span><i class="fa fa-heart-o"></i> <a href="javascript:void(0);" class="add_to_likelist" data-id="<?php the_ID(); ?>"><?php echo '<span>'.(int)get_post_meta(get_the_id(), '_sh_like_it', true).'</span>'; esc_html_e(' likes', SH_NAME);?> </a> </span> | <span><i class="fa fa-eye"></i> <a class="post_view" href="javascript:void(0);"><?php echo _WSH()->post_views(); ?> <?php _e('Viewers', SH_NAME); ?></a> </span> </div>
				</div>
				<?php the_content();?>
				
				<?php the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' ); ?>
				
			  <!--======= ADMIN INFO =========-->
			  <h4 class="text-uppercase margin-t-40"><?php esc_html_e('About author', SH_NAME);?></h4>
			  <div class="admin-info">
				<ul>
				  <li class="col-xs-3 no-padding text-center"> 
				  <?php echo get_avatar(get_the_author_meta( 'ID' ), 270 ); ?>
				  <!--======= SOCIAL ICONS =========-->
				  <ul class="social_icons">
					  <li class="facebook"> <a href="<?php the_author_meta( 'facebook', get_the_author_meta('ID') ); ?>"><i class="fa fa-facebook"></i> </a></li>
					  <li class="twitter"> <a href="<?php the_author_meta( 'twitter', get_the_author_meta('ID') ); ?>"><i class="fa fa-twitter"></i> </a></li>
					  <li class="linkedin"> <a href="<?php the_author_meta( 'linkedin', get_the_author_meta('ID') ); ?>"><i class="fa fa-linkedin"></i> </a></li>
					</ul> </li>
					
					<!--======= ABOUT AUTHER =========-->
				  <li class="col-xs-9">
				  <h3><?php esc_html_e('About Author', SH_NAME);?></h3>
					<h5 class="text-uppercase no-margin"><?php the_author();?></h5>
					<br>
					<p><?php the_author_meta( 'description', get_the_author_meta('ID') ); ?></p>
					</li>
				</ul>
			  </div>
	  
			  <!-- comment area -->
	 			 <?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', SH_NAME), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
	  			 <?php comments_template(); ?><!-- end comments -->

			  </li>
			</ul>
		  </section>
		</div>
	  </div>
	  <?php endwhile;?>
	</div>
	
	<?php if( $layout == 'right' && is_active_sidebar( $sidebar ) ): ?>
		<div class="col-sm-3 side-bar">
				<?php dynamic_sidebar( $sidebar ); ?>
		</div>
    <?php endif; ?>
	
  </div>
</div>
</section>

<?php get_footer(); ?>