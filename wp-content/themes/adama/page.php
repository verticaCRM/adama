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
$sidebar = sh_set( $meta, 'sidebar', 'product-sidebar' );
$classes = ( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) ? ' col-md-12 col-sm-12 col-xs-12' : ' col-md-8 col-sm-8 col-xs-12';
$bg = sh_set( $meta1, 'bg_image' );
$title = sh_set( $meta1, 'header_title' );
/** Update the post views counter */
//_WSH()->post_views( true );?>

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

<section >
<div class="container">
	<div class="row">
		
		<?php if( $layout == 'left' ): ?>
		
                <div class="col-md-4 col-sm-4 col-xs-12">
                        <div id="sidebar" class="clearfix">        
							<?php dynamic_sidebar( $sidebar ); ?>
                		</div>
                </div>
		
		<?php endif; ?><!-- end sidebar -->	

		<div class="<?php echo esc_attr($classes);?>">                    
			<?php while( have_posts() ): the_post(); ?>
            	<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
					<div class="blog row m0 single_post">
						
						<div class="desc">
							<?php the_content();?>
						</div>
						
						<?php the_tags('<div class="tags">', ', ', '</div>');?>
						
						<div class="clearfix"></div>
						
						<?php comments_template(); ?><!-- end comments -->
			
					</div>
				</div>
			
			<?php endwhile;?>
			
		</div>
		
		<?php if( $layout == 'right' ): ?>
		
                <div class="pull-right col-md-4 col-sm-4 col-xs-12">
                        <div id="sidebar" class="clearfix">        
							<?php dynamic_sidebar( $sidebar ); ?>
                		</div>
                </div>
		
		<?php endif; ?><!-- end sidebar -->

	</div>
</div>
</section>

<?php get_footer(); ?>

