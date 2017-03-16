<?php $options = _WSH()->option();
$top_heading_img= get_template_directory_uri()."/images/head-top.png";
$top_heading_img = sh_set( $options, 'top_heading_img' ) ? sh_set( $options, 'top_heading_img' ) : $top_heading_img;
get_header(); 

wp_enqueue_script('print-script');

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
//_WSH()->post_views( true );?>

<!--======= BANNER =========-->
<div class="sub-banner" <?php if($bg):?>style="background-image: url('<?php echo esc_url($bg); ?>');"<?php endif;?>>
	<div class="overlay">
		<div class="container">
			<h1><?php if($title) echo  balanceTags( $title ); else echo 'Property Detail';?></h1>
			<ol class="breadcrumb">
				<li class="pull-left"><?php if($title) echo  balanceTags( $title ); else echo 'Property Detail';?></li>
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
					
					$property_meta = _WSH()->get_meta();
					$map_meta = $property_meta;
					$agents_term = get_the_terms(get_the_id(), 'property_agent');
					if( $agents_term )
						$meta = _WSH()->get_term_meta('_sh_property_agent_settings'.$agents_term[0]->term_id);
					else $meta = array();
					?>

					<!--======= THUMB SLIDER =========-->
					<?php if($images = sh_set($property_meta, 'sh_gallery_imgs')):?>
					
						<div class="print">
							<div class="thumb-slider">
								<div id="slider" class="flexslider">
									<ul class="slides">

										<?php foreach($images as $key => $value):?>
											<li> <img class="img-responsive" src="<?php echo sh_set($value, 'gallery_image');?>" alt="image" > </li>
										<?php endforeach;?>

									</ul>
								</div>

								<!--======= THUMBS =========-->
								<div id="carousel" class="flexslider">
									<ul class="slides">

										<?php foreach($images as $key => $value):?>
											<li> <img class="img-responsive" src="<?php echo sh_set($value, 'gallery_image');?>" alt=""> </li>
										<?php endforeach;?>

									</ul>
								</div>
							</div>
						</div>
					
					<?php endif;?>

					<!--======= HOME INNER DETAILS =========-->
					<ul class="home-in">
						<li><span><i class="fa fa-home"></i> <?php echo sh_set($property_meta, 'area');?></span></li>
						<li><span><i class="fa fa-bed"></i> <?php echo sh_set($property_meta, 'bedrooms');?></span></li>
						<li><span><i class="fa fa-tty"></i> <?php echo sh_set($property_meta, 'bathrooms');?></span></li>
						<li><span><a href="javascript:;" id="_print_this"><i class="fa fa-print"></i> <?php esc_html_e('Print This Details', SH_NAME); ?></a></span></li>
					</ul>

					<!--======= TITTLE =========-->
					<h5><?php the_title();?></h5>
					
					<section> 
						<?php if(sh_set($property_meta, 'property_status') == 'sale'):?> 
							<span class="sale-tag font-montserrat sale"><?php esc_html_e('FOR SALE', SH_NAME);?></span>
						<?php endif;?>
						<?php if(sh_set($property_meta, 'property_status') == 'rent'):?> 
							<span class="sale-tag font-montserrat rent"><?php esc_html_e('FOR RENT', SH_NAME);?></span>
						<?php endif;?> 

						<span class="sale-tag price font-montserrat"><?php echo sh_set($property_meta, 'price');?></span> 

					</section>
					
					<?php the_content();?>

					<!--======= OWNER DETSILS =========-->
					<section class="info-property">
						<h5 class="tittle-head"><?php esc_html_e('Property Details', SH_NAME);?></h5>
						<div class="inner"> 

							<!--======= OWNER =========-->
							<div class="row">
								<div class="col-sm-2"> <?php echo wp_get_attachment_image(_sh_get_attachment_id_from_src(sh_set($meta, 'agent_img')), '91x91');?></div>
								<div class="col-sm-10">
									<ul class="row">
										<li class="col-sm-4">
											<p><span class="font-montserrat"><?php esc_html_e('Address ', SH_NAME);?></span><?php echo sh_set($property_meta, 'address');?></p>
											<p><span class="font-montserrat"><?php esc_html_e('ZIP ', SH_NAME);?></span><?php echo sh_set($property_meta, 'zip_code');?></p>
										</li>
										<li class="col-sm-4">
											<?php /* for categories without anchor*/ $term_list = wp_get_post_terms(get_the_id(), 'property_city', array("fields" => "names")); ?>
											<p><span class="font-montserrat"><?php esc_html_e('City ', SH_NAME);?></span><?php echo implode( ', ', (array)$term_list );?></p>
											<p><span class="font-montserrat"><?php esc_html_e('counrty ', SH_NAME);?></span><?php echo sh_set($options, 'sh_base_country');?></p>
										</li>
										<li class="col-sm-4">
											<p><span class="font-montserrat"><?php esc_html_e(' Area ', SH_NAME);?></span><?php echo sh_set($property_meta, 'area');?></p>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</section>

				<?php endwhile; ?>

			<!--======= PROPERTY FEATURES =========-->
			<section class="info-property more">
				<h5 class="tittle-head"><?php esc_html_e('Property features', SH_NAME);?></h5>
				<div class="inner"> 

					<!--======= FEATURE DETAILS =========-->
					<?php if($features = sh_set($property_meta, 'features')):
					
						$features_arr = explode("\n", $features); ?>

						<ul class="row">
							<?php foreach((array)$features_arr as $key => $value):?>

								<li class="col-sm-3">
									<p><?php echo balanceTags($value);?></p>
								</li>

							<?php endforeach;?>

						</ul>

					<?php endif;?>

				</div>
			</section>

			<!--======= PROPERTY FEATURES =========-->
			<section class="info-property agents-info">
				
				<h5 class="tittle-head"><?php esc_html_e('agent details', SH_NAME);?></h5>
				<div class="inner"> 
					
					<!--======= AGENT DETAILS =========-->
					<div class="row">
						<div class="col-sm-3"> 
							<?php echo wp_get_attachment_image(_sh_get_attachment_id_from_src(sh_set($meta, 'agent_img')), '270x288');?>
						</div>
						<div class="col-sm-9">
							<?php $term_list = wp_get_post_terms(get_the_id(), 'property_agent', array("fields" => "names")); ?>
							<h5><?php echo implode( ', ', (array)$term_list );?></h5>
							<!--======= SOCIAL ICONS =========-->
							<ul class="social_icons">
								<li class="facebook"><a href="<?php echo sh_set($meta, 'facebook_link');?>"><i class="fa fa-facebook"></i></a></li>
								<li class="twitter"><a href="<?php echo sh_set($meta, 'twitter_link');?>"><i class="fa fa-twitter"></i></a></li>
								<li class="googleplus"><a href="<?php echo sh_set($meta, 'google_plus_link');?>"><i class="fa fa-google-plus"></i></a></li>
								<li class="linkedin"><a href="<?php echo sh_set($meta, 'linked_in_link');?>"><i class="fa fa-linkedin"></i></a></li>
							</ul>
							<p><?php $description = $agents_term[0]->description; echo $description;?></p>

							<!--======= AGENT INFOR =========-->
							<ul class="agent-info">
								<li>
									<p><i class="fa fa-phone"></i> <?php echo sh_set($meta, 'phone');?> </p>
								</li>
								<li>
									<p><i class="fa fa-envelope-o"></i> <?php echo sh_set($meta, 'email');?> </p>
								</li>
								<li>
									<p><i class="fa fa-home"></i> <?php printf( esc_html__('Listed %s Properties', SH_NAME), sh_set(sh_set($agents_term, 0 ) , 'count' ) );?> </p>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>

			<!--======= PROPERTY FEATURES =========-->
			<section class="info-property location">
				<h5 class="tittle-head"><?php esc_html_e('property location', SH_NAME);?></h5>
				<div class="inner"><div id="street-map" style="height: 300px;"></div> </div>
			</section>
			
			</div>
			
			<?php if( $layout == 'right' && is_active_sidebar( $sidebar ) ): ?>
				<div class="col-sm-3 side-bar">
					<?php dynamic_sidebar( $sidebar ); ?>
				</div>
			<?php endif; ?>
			<!-- end sidebar --> 

		</div>
		
	</div>
</section>

<?php $terms = get_the_terms(get_the_id(), 'property_category' ); 
$first_tag = current( (array) $terms );

$args=array(
	'property_category' => $first_tag->slug,
	'post__not_in' => array($post->ID),
	'posts_per_page'=>3,
	'ignore_sticky_posts'=>1
);

$my_query = new WP_Query($args);?>

<?php if( $my_query->have_posts() ): ?>	

	<!--======= PROPERTY =========-->
	<section class="properties white-bg">
		<div class="container"> 

			<!--======= TITTLE =========-->
			<div class="tittle"> <img src="<?php  echo $top_heading_img;  ?>" alt="">
				<h3><?php echo sh_set($options, 'sh_property_title');?></h3>
				<p><?php echo sh_set($options, 'sh_property_subtitle');?></p>
			</div>

			<!--======= PROPERTIES ROW =========-->
			<ul class="row">

				<?php while( $my_query->have_posts() ): $my_query->the_post(); 
					
					$property_meta = _WSH()->get_meta();
					$agents_term = get_the_terms(get_the_id(), 'property_agent');
					if( $agents_term )
						$meta = _WSH()->get_term_meta('_sh_property_agent_settings'.$agents_term[0]->term_id);
					else $meta = array();	
					?>
					
					<!--======= PROPERTY =========-->
					<li class="col-sm-4"> 
						<!--======= TAGS =========-->

						<section> 
							<!--======= IMAGE =========-->
							<div class="img"> 
								<?php the_post_thumbnail('370x230', array('class' => 'img-responsive'));?>
								<!--======= IMAGE HOVER =========-->

								<div class="over-proper"> <a href="<?php the_permalink();?>" class="btn font-montserrat"><?php esc_html_e('more details', SH_NAME);?></a> </div>
							</div>
							<!--======= HOME INNER DETAILS =========-->
							<ul class="home-in">
								<li><span><i class="fa fa-home"></i> <?php echo sh_set($property_meta, 'area');?></span></li>
								<li><span><i class="fa fa-bed"></i> <?php echo sh_set($property_meta, 'bedrooms');?></span></li>
								<li><span><i class="fa fa-tty"></i> <?php echo sh_set($property_meta, 'bathrooms');?></span></li>
							</ul>
							<!--======= HOME DETAILS =========-->
							<div class="detail-sec"> <a href="<?php the_permalink();?>" class="font-montserrat"><?php the_title();?></a> <span class="locate"><i class="fa fa-map-marker"></i> <?php echo sh_set($property_meta, 'address');?></span> <span class="price-bg  font-montserrat"><?php echo sh_set($property_meta, 'price');?></span> <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('more details', SH_NAME);?></a> </div>
						</section>
					</li>

				<?php endwhile;?>

			</ul>
		</div>
	</section>

<?php endif;?>

<?php wp_enqueue_script(array('jquery-mapmarker')); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

<!-- begin map script--> 
<script type="text/javascript">
	// Use below link if you want to get latitude & longitude
	// http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude.php 
	jQuery(document).ready(function($){
	//set up markers 
	var myMarkers = {"markers": [{
			
		"latitude": "<?php echo sh_set($map_meta, 'lat'); ?>",
		"longitude":"<?php echo sh_set($map_meta, 'long'); ?>",
		
		"icon": "<?php echo get_template_directory_uri(); ?>/images/map-locator.png", 
		"baloon_text": <?php echo json_encode(sh_set($map_meta, 'address')); ?>
	}]};
		
	//set up map options
	$("#street-map").mapmarker({
	  zoom  : 17,
	  center  : <?php echo json_encode(sh_set($map_meta, 'address')); ?>,
	  markers : myMarkers
	  });
	});
</script>

<?php wp_reset_postdata();

get_footer(); ?>