<?php 
get_header();
global $post;

$queried_object = get_queried_object();

$ThemeSettings = _WSH()->option();

$PageSettings  = get_post_meta(get_the_ID(), 'sh_post_meta', true);

$layout_meta = _WSH()->get_meta( '_sh_layout_settings' );
$header_meta = _WSH()->get_meta( '_sh_header_settings' );


$page_layout = sh_set($layout_meta, 'layout');

$page_sidebar = sh_set($layout_meta, 'sidebar');

$inner_col_class = (!$page_layout || $page_layout == 'full' ) ? 'col-md-12 ' : 'col-md-9 col-sm-8 ' ;
?>

<?php $header_title = sh_set( $header_meta, 'header_title' ) ? $header_meta['header_title'] : get_the_title();
	  $header_tagline = sh_set( $header_meta, 'tagline' ) ? $header_meta['tagline'] : get_bloginfo ( 'description' );
?>

<section id="single-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-title">
                    <h3><?php echo balanceTags($header_title);?></h3>
                    <p><?php echo balanceTags($header_tagline);?></p>
                </div>

                <div class="breadcrumb-container">
                        <?php echo get_the_breadcrumb(); ?>
                </div>
            </div>
        </div><!-- end row -->
    </div>  
</section><!-- end white -->

<section class="white-wrapper border-top nopadding">
    
    <div class="container">
        <div class="row">
        	
    		<?php if($page_layout == 'left' ): ?>

                <div id="sidebar" class="col-md-3 col-sm-4 col-xs-12">
        
                    <?php dynamic_sidebar( $page_sidebar); ?>
        
                </div>

     	    <?php endif;?>

            <div id="content" class="col-md-12 col-sm-12 col-xs-12">
            
            	<?php while(have_posts()): the_post();
    				$project_meta = _WSH()->get_meta();
    			?>
                
                <div class="row single-portfolio">
                    <div class="portfolio-media col-md-6 col-sm-6 col-xs-12">

                        <?php if(has_post_thumbnail()):?>
                        <div class="media-element entry">
                        	<?php
    							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
    							$url = $thumb['0'];
    						?>
                            <?php the_post_thumbnail('600x600', array('class' => 'img-responsive'));?>
                            <div class="magnifier outline-outward">
                                <div class="buttons">
                                    <a class="portfoliobuttons" href="<?php echo esc_url($url);?>" data-gal="prettyPhoto[product-gallery]" title=""><i class="icon-search"></i></a> 
                                </div>
                            </div>
                        </div><!-- end entry -->
    					<?php endif?>
                        

                        <?php if($thumbnails = sh_set($project_meta, 'sh_gallery_imgs' )): ?>
                		<?php foreach( $thumbnails as $thumbnail ):
                                if(sh_set($thumbnail, 'gallery_image') == '') continue;

                                $att_id = sh_get_attachment_id_by_url( sh_set($thumbnail, 'gallery_image') );
                                if( !$att_id ) continue;?>

                                <hr class="clearfix">
                                <div class="media-element entry clearfix">
                                	<?php ?>
                                	<?php echo wp_get_attachment_image( $att_id, '600x600', '',  array('class'=>'img-responsive') ); ?>
                                    <div class="magnifier outline-outward">
                                        <div class="buttons">
                                            <a class="portfoliobuttons" href="<?php echo esc_url(sh_set($thumbnail, 'gallery_image') );?>" data-gal="prettyPhoto[product-gallery]" title=""><i class="icon-search"></i></a> 
                                        </div>
                                    </div>
                                </div><!-- end entry -->
                            
                        <?php endforeach; 
    						  endif;
    					?>

                    </div><!-- end portfolio-media -->

                    <div class="portfolio-desc col-md-6 col-sm-6 col-xs-12">
                        <div class="title text-left">
                            <h3 class="section-title"><?php the_title();?></h3>
                            <p class="lead"><?php echo balanceTags(sh_set($project_meta, 'proj_desc'));?></p>
                        </div><!-- end section-title -->

                        <?php the_content();?>

                        <div class="clearfix button-wrapper">
                            <a class="btn btn-primary" href="<?php echo esc_url( sh_set($project_meta, 'proj_link') );?>"><?php esc_html_e('OPEN PROJECT', SH_NAME);?></a>
                        </div>
                    </div><!-- end portfolio-desc -->
                </div><!-- end single-portfolio -->
                
    			<?php endwhile;?>
            
            </div><!-- end content -->
            
    		<?php if($page_layout == 'right' ): ?>

                <div id="sidebar" class="col-md-3 col-sm-4 col-xs-12">
        
                    <?php dynamic_sidebar( $page_sidebar); ?>  
        
                </div><!-- end sidebar -->

          	<?php endif;?> <!-- end sidebar -->
        
        </div><!-- end row -->
    </div><!-- end container -->

</section><!-- end white -->

<?php _Sh_footer_clients('projects'); ?>

<?php get_footer(); ?>