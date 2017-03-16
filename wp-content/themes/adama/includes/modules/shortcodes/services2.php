<?php  
$count = 1; 
$query_args = array('post_type' => 'sh_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['services_category'] = $cat;
$query = new WP_Query($query_args) ; 
$settings  = _WSH()->option();
$top_heading_img= get_template_directory_uri()."/images/head-top.png";
$top_heading_img = sh_set( $settings, 'top_heading_img' ) ? sh_set( $settings, 'top_heading_img' ) : $top_heading_img;
$data_filtration = '';
$data_posts = '';
ob_start() ;?>
<?php if( $query->have_posts() ):?>

	<?php while($query->have_posts()): $query->the_post();
	global $post ;
	$services_meta = _WSH()->get_meta(); 
	?>
	<?php
	$active = ($count == 1) ? 'class="active"' : '';
	$active2 = ($count == 1) ? 'active' : ''; 
	
	$data_filtration[get_the_id()] = '<li role="presentation" '.$active.'><a href="#what-'.get_the_id().'" role="tab" data-toggle="tab"><i class="fa '.sh_set($services_meta, 'service_icon').'"></i> <span class="font-montserrat">'.get_the_title(get_the_id()).'</span></a></li>';?>

	<!--======= WHAT WE DO =========-->
	<div role="tabpanel" class="tab-pane animated-6s flipInX <?php echo esc_attr($active2);?>" id="what-<?php echo get_the_id();?>">
		<h4><?php the_title();?></h4>
		<p><?php echo _sh_trim(get_the_content(), $text_limit);?></p>
	</div>	 

	<?php $count++; endwhile;?>

	<?php $data_posts = ob_get_contents();
	ob_end_clean();
	endif;

	ob_start() ; 
	?>
	<!--======= WHAT WE DO =========-->
	<section class="what-we-do">
		<div class="container"> 

			<!--======= TITTLE =========-->
			<div class="tittle"> <img src="<?php  echo $top_heading_img;  ?>" alt="">
				<h3><?php echo balanceTags($title);?></h3>
				<p><?php echo balanceTags($text);?></p>
			</div>
			<div role="tabpanel"> 

				<!--======= NAV TABS =========-->
				<ul class="nav nav-tabs" role="tablist">
					<?php echo implode("\n",$data_filtration);?>
				</ul>

				<!--======= TAB CONTENT =========-->
				<div class="tab-content">

					<!--======= WHAT WE DO =========-->
					<?php echo balanceTags($data_posts);?>
				</div>
			</div>
		</div>
	</section>

<?php wp_reset_postdata();
return ob_get_clean();