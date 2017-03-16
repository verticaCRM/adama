<?php  
$count = 1; 
$query_args = array('post_type' => 'sh_testimonial' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['testimonial_category'] = $cat;

$query = new WP_Query($query_args) ; 
ob_start() ;?>

<?php if( $query->have_posts() ):?>

	<!--======= TESTIMONILAS =========-->
	<section id="testimonials">
		<div class="container"> 

			<!--======= TITTLE =========-->
			<div class="tittle">
				<h3><?php echo balanceTags($title);?></h3>
			</div>
			<div class="testi">
				<div class="testi-slide">

					<?php while($query->have_posts()): $query->the_post();
						global $post;
						$post_meta = _WSH()->get_meta(); 
						?>	

						<div class="item">
							<div class="avatar"><?php the_post_thumbnail('86x86', array('class' => 'img-responsive'));?></div>
							<p><?php echo _sh_trim(get_the_content(), $text_limit);?></p>
							<h5><?php the_title();?></h5>
							<span><?php echo sh_set($post_meta, 'location');?></span> 
						</div>

					<?php endwhile;?>		

				</div>
			</div>
		</div>
	</section>

<?php endif;?>		

<?php wp_reset_postdata();

return ob_get_clean();