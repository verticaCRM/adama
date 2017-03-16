<?php  
$count = 1; 
$query_args = array('post_type' => 'sh_property' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['property_category'] = $cat;
$query = new WP_Query($query_args) ; 

ob_start() ;?>

<?php if( $query->have_posts() ):?>

	<!--======= PROPERTY =========-->
	<section class="property-slide"> 

		<!--======= PROPERTY SLIDER =========-->
		<div class="prot-slide"> 

			<?php while($query->have_posts()): $query->the_post();
				
				global $post ;
				$agents_term = get_the_terms(get_the_id(), 'property_agent');
				$property_meta = _WSH()->get_meta();

				if( $agents_term )
					$meta = _WSH()->get_term_meta('_sh_property_agent_settings'.$agents_term[0]->term_id);
				else $meta = array();?>

				<!--======= PROPERTY SLIDE =========-->
				<div class="plots">
					<div class="row">

						<div class="col-xs-4"> 
							<a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>">

								<?php the_post_thumbnail('163x150', array('class' => 'img-responsive'));?> 

							</a> 
						</div>

						<div class="col-xs-8">
							<div class="pri-info"> <span class="sale"><?php echo esc_html_e('For ', SH_NAME).sh_set($property_meta, 'property_status');?></span> <a class="f-mont" href="<?php the_permalink();?>"><?php echo sh_set($property_meta, 'price');?> <?php the_title();?></a>
								<p><i class="fa fa-map-marker"></i> <?php echo sh_set($property_meta, 'address');?></p>
								<div class="auther"> <img src="<?php echo sh_set($meta, 'agent_img');?>" alt="image">
									<?php $term_list = wp_get_post_terms(get_the_id(), 'property_agent', array("fields" => "names")); ?>
									<h6><?php echo implode( ', ', (array)$term_list );?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php endwhile;?>

		</div>
	</section>

<?php endif;?>		

<?php wp_reset_postdata();
return ob_get_clean();