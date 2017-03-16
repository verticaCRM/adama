<?php global $wp_query;
$count = 0; 
$query_args = array('post_type' => 'sh_testimonial' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['testimonial_category'] = $cat;
$query = new WP_Query($query_args) ;

$data_filtration = '';
$data_posts = '';
?> 

<?php if( $query->have_posts() ):

	ob_start() ;?>
	
	<?php while( $query-> have_posts() ): $query-> the_post(); $meta = _WSH()->get_meta() ;?>
		
		<?php $active = ($count == 0) ? 'class="active"' : '';
		$active2 = ($count == 0) ? 'active' : '';
		$data_filtration[get_the_id()] = '<li data-target="#carousel-example-generic" data-slide-to="'.$count.'" '.$active.'> '.get_the_post_thumbnail( get_the_id(), '86x86', array('class' => 'img-responsive') ).' </li>'; 
		?>
		
		<!--======= SLIDER 1 =========-->
		<div class="item <?php echo esc_attr($active2);?>">
			<p><?php echo _sh_trim(get_the_content(), $text_limit);?></p>
			<h5><?php the_title();?></h5>
			<span><?php echo sh_set($meta, 'location');?></span> 
		</div>

		<?php $count++; 
	endwhile;?>

	<?php $data_posts = ob_get_contents();
	ob_end_clean();

endif; 
wp_reset_postdata();

ob_start();?>


<!--======= TESTIMONILAS =========-->
<section id="testimonials">
	<div class="container"> 

		<!--======= TITTLE =========-->
		<div class="tittle">
			<h3><?php echo balanceTags($title);?></h3>
		</div>
		<div class="testi"> 

			<!--======= TESTIMONIALS SLIDERS CAROUSEL =========-->
			<div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">
				<div class="row">
					<div class="col-md-12"> <img src="<?php echo get_template_directory_uri();?>/images/comment-icon.png" alt="">
						<div class="carousel-inner" role="listbox"> 

							<?php echo balanceTags($data_posts);?>

						</div>
					</div>

					<!--======= SLIDER AVATARS =========-->
					<div class="col-md-12">
						<ol class="carousel-indicators">

							<?php echo implode("\n", (array)$data_filtration);?>

						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php return ob_get_clean(); ?>