<?php  $count = 1; 
$settings  = _WSH()->option();
$query_args = array('post_type' => 'sh_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['services_category'] = $cat;
$query = new WP_Query($query_args) ; 
$top_heading_img= get_template_directory_uri()."/images/head-top.png";
$top_heading_img = sh_set( $settings, 'top_heading_img' ) ? sh_set( $settings, 'top_heading_img' ) : $top_heading_img;
//printr($top_heading_img);

ob_start() ;?>

<?php if( $query->have_posts() ):?>

	<!--======= SERVICES =========-->
	<section class="services">
		<div class="container"> 

			<!--======= TITTLE =========-->
			<div class="tittle"> <img src="<?php  echo $top_heading_img;  ?>" alt="">
				<h3><?php echo balanceTags($title);?></h3>
				<p><?php echo balanceTags($text);?></p>
			</div>
			<ul class="row">

				<?php while($query->have_posts()): $query->the_post();
				global $post ;
				$services_meta = _WSH()->get_meta(); 
				?>

				<!--======= SERVICE SECTION =========-->
				<li class="col-md-3 col-sm-4 col-xs-6">
					<section> 
						<!--======= SERVICE IMG =========--> 
						<?php the_post_thumbnail('271x337', array('class' => 'img-responsive'));?>
						<div class="icon"> <img src="<?php echo sh_set($services_meta, 'small_image');?>" alt="image"> </div>

						<!--======= SERVICE HOVER =========-->
						<div class="ser-hover">
							<p><?php echo _sh_trim(get_the_content(), $text_limit);?> <a href="<?php echo sh_set($services_meta, 'readmore_link');?>" class="read-more"><?php esc_html_e('Read more ', SH_NAME);?><i class="fa fa-angle-double-right"></i></a> </p>
						</div>
						<a href="<?php echo sh_set($services_meta, 'readmore_link');?>" class="heading"><?php the_title();?></a> </section>
					</li>

				<?php endwhile;?>

			</ul>
		</div>
	</section>

<?php endif;?>		
<?php wp_reset_postdata();
return ob_get_clean();