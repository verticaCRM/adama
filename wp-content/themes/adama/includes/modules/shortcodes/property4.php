<?php  $count = 1; 

$query_args = array('post_type' => 'sh_property' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['property_category'] = $cat;
$query = new WP_Query($query_args) ; 

ob_start() ;?>

<?php if( $query->have_posts() ):?>

	<h6><?php echo balanceTags($title);?></h6>
	<ul>

		<?php while($query->have_posts()): $query->the_post();
		global $post ;
		$property_meta = _WSH()->get_meta(); 
		?>

		<!--======= PROPERTIRES SMALL POST =========-->
		<li>
			<div class="img"> <a href="<?php the_permalink();?>"><?php the_post_thumbnail('86x86', array('class' => 'img-responsive'));?></a></div>
			<div class="text-po"> <a href="<?php the_permalink();?>"><?php the_title();?></a>
				<div class="locat"> 
					<?php if(sh_set($property_meta, 'show_address')):?><p> <span><i class="fa fa-map-marker"></i> </span> <?php echo sh_set($property_meta, 'address');?></p><?php endif;?>
					<?php if(sh_set($property_meta, 'show_ratting')):?>

						<?php
						$ratting = sh_set($recipes_meta, 'property_rating');

						for ($x = 1; $x <= 5; $x++) {
							if($x <= $ratting) echo '<span><i class="fa fa-star"></i></span>'; else echo '<span><i class="fa fa-star-half-o"></i></span>'; 
						}
						?> 

					<?php endif;?> 
				</div>
				<span class="font-montserrat"><?php echo sh_set($property_meta, 'price');?></span> </div>
			</li>

		<?php endwhile;?>

	</ul>

<?php endif;?>
<?php wp_reset_postdata();
return ob_get_clean();