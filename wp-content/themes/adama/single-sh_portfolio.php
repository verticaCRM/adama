<?php 

get_header();

global $post;



$layout_meta = _WSH()->get_meta( '_sh_layout_settings' );

$header_meta = _WSH()->get_meta( '_sh_header_settings' );

$meta = _WSH()->get_meta();




$page_layout = sh_set($layout_meta, 'layout');

$page_sidebar = sh_set($layout_meta, 'sidebar');

$inner_col_class = (!$page_layout || $page_layout == 'full' ) ? 'col-md-12 ' : 'col-md-9 col-sm-8 ' ;

?>



<?php $header_title = sh_set( $header_meta, 'header_title' ) ? $header_meta['header_title'] : get_the_title();

$header_bg_image = sh_set( $header_meta, 'header_bg_image' ) ? ' style="background-image:url('.$header_meta['header_bg_image'].');"' : '';

?>



<section class="page-white bgpatttern clearfix"<?php echo esc_attr($header_bg_image); ?>>



    <div class="section-title">

        <h3><?php if($header_title) echo balanceTags($header_title); else echo wp_title('');?></h3>

        <span class="divider2"></span>

        <div class="breadcrumb-container">

             <?php echo get_the_breadcrumb(); ?>

        </div>

    </div><!-- end section title -->



</section>



<section class="section-w clearfix">

    <div class="container">

        

        <?php while( have_posts() ): the_post(); 



            $meta = _WSH()->get_meta();?>



            <div class="row single-portfolio">

                <div class="col-md-8 col-sm-8">

                    <div class="media">

                        <div class="entry">



                            <?php the_post_thumbnail('770x641', array('class'=>'img-responsive')); ?>

                            

                            <?php if( $featured_img = wp_get_attachment_url(get_post_thumbnail_id())):?>

                                

                                <div class="magnifier">

                                    

                                    <a href="<?php echo esc_url($featured_img); ?>" data-gal="prettyPhoto[product-gallery]">

                                    <span class="buttons">

                                        <i class="fa fa-search"></i>

                                    </span>

                                    </a>

                                </div>

                            

                            <?php endif; ?>

                        

                        </div>

                    </div><!-- end media -->
                    
					<?php echo sh_set($meta, 'audio');?>
                    
                    <?php echo sh_set($meta, 'video');?>



                    <?php $gallery_images = sh_set($meta, 'portfolio_images'); //printr($gallery_images);



                    if( $gallery_images && function_exists('_sh_get_attachment_id_from_src') )

                    foreach( $gallery_images as $gal_img ): 



                        $single_image = sh_set($gal_img, 'image');

                        if( !esc_url($single_image) ) continue; 



                        $attachment_id = _sh_get_attachment_id_from_src($single_image);

                        $single_image = ($attachment_id) ? sh_set(wp_get_attachment_image_src($attachment_id, '770x641'), 0) : $single_image;?>

                    

                        <div class="media">

                            <div class="entry">

                                <img src="<?php echo esc_url($single_image); ?>" alt="<?php the_title_attribute(); ?>" class="img-responsive">



                                <div class="magnifier">

                                    <a href="<?php echo esc_url(sh_set($gal_img, 'image')); ?>" title="<?php the_title_attribute(); ?>" data-gal="prettyPhoto[product-gallery]">

                                    <span class="buttons">

                                        <i class="fa fa-search"></i>

                                    </span>

                                    </a>

                                </div>

                            </div>

                        </div><!-- end media -->

                    

                    <?php endforeach; ?>



                    <div class="post_bottom clearfix">

                        <div class="next_prev text-center">

                            <ul class="pager">

                                <li class="previous"><?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i>', FALSE); ?></li>

                                <li class="next"><?php next_post_link('%link', '<i class="fa fa-long-arrow-right"></i>', FALSE); ?></li>

                            </ul>

                        </div><!-- next_prev --> 

                    </div><!-- post bottom -->



                </div><!-- end col -->



                <div class="col-md-4 col-sm-4">

                    <div class="widget">

                        

                        <div class="widget-title">

                            <h3><span class="divider"></span> <?php esc_html_e('Description', SH_NAME); ?></h3>

                        </div><!-- end widget title -->

                        

                        <?php the_content(); ?>



                    </div><!-- end widget -->



                    <?php $services_section = sh_set($meta, 'accordion'); 



                    if( $services_section ): ?>



                        <div class="widget">

                            <div class="widget-title">

                                <h3><span class="divider"></span> <?php esc_html_e('Whats New?', SH_NAME); ?></h3>

                            </div><!-- end widget title -->

                            

                            <div class="accordion-widget">

                                <div id="accordion-first" class="clearfix">

                                    <div class="accordion" id="accordion1">

                                        

                                        <?php foreach ($services_section as $key => $value) : 



                                            if( !$value ) continue; ?>

                                            

                                            <div class="accordion-group">

                                                <div class="accordion-heading">

                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne<?php echo esc_attr($key); ?>">

                                                        <em class="fa fa-arrow-<?php echo ($key == 0) ? 'right' : 'down'; ?> icon-fixed-width"></em><?php echo balanceTags(sh_set($value, 'title')); ?>

                                                    </a>

                                                </div>

                                                <div id="collapseOne<?php echo esc_attr($key); ?>" class="accordion-body collapse<?php echo ($key == 0) ? ' in' : ''; ?>">

                                                    <div class="accordion-inner">

                                                        <?php echo apply_filters('the_content', sh_set($value, 'content') ); ?>

                                                    </div>

                                                </div>

                                            </div>



                                        <?php endforeach; ?>

                                        

                                    </div><!-- end accordion -->

                                </div><!-- end accordion first -->

                            </div><!-- end accordion-widget -->

                        </div><!-- end widget -->



                    <?php endif; ?>

                    

                    <div class="widget">

                        

                        <div class="widget-title">

                            <h3><span class="divider"></span> <?php echo sh_set( $meta, 'project_detail_title', esc_html__('Project Details') ); ?></h3>

                        </div><!-- end widget title -->

                        

                        <?php $extra_detail = sh_set( $meta, 'extra_detail' ); //printr($extra_detail);

                        

                        if($extra_detail)

                        foreach ($extra_detail as $key => $value) : 

                            if( !sh_set($value, 'value') ) continue;?>

                            <p><strong><?php echo sh_set( $value, 'label'); ?> : </strong> <?php echo sh_set($value, 'value'); ?></p>

                        <?php endforeach;?>

                         

                        <?php echo get_the_term_list(get_the_id(), 'portfolio_category', '<p><strong>'.esc_html__('Category', SH_NAME).':</strong> ', ', ', '</p>'); ?>

                    </div><!-- end widget -->



                </div><!-- end col -->

            </div><!-- end row -->

        <?php endwhile; ?>



    </div><!-- end container -->

</section><!-- end section -->





<?php get_footer(); ?>