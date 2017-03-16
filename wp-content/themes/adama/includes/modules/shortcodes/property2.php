<?php  
$count = 1; 
$query_args = array('post_type' => 'sh_property' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['property_category'] = $cat;
$query = new WP_Query($query_args) ; 
$settings  = _WSH()->option();
$top_heading_img= get_template_directory_uri()."/images/head-top.png";
$top_heading_img = sh_set( $settings, 'top_heading_img' ) ? sh_set( $settings, 'top_heading_img' ) : $top_heading_img;
ob_start() ;?>

<?php if( $query->have_posts() ):?>

	<!--======= PROPERTY =========-->
	<section class="properties">
		<div class="container"> 

			<!--======= TITTLE =========-->
			<div class="tittle"> <img src="<?php  echo $top_heading_img;  ?>" alt="">
				<h3><?php echo balanceTags($title);?></h3>
				<p><?php echo balanceTags($text);?></p>
			</div>

			<!--======= PROPERTIES ROW =========-->
			<ul class="row">

				<?php while($query->have_posts()): $query->the_post();
					
					global $post ;
					$property_meta = _WSH()->get_meta(); ?>

					<!--======= PROPERTY =========-->
					<li class="col-md-4 col-sm-6"> 
						
						<!--======= TAGS =========-->
						<?php if(sh_set($property_meta, 'property_status') == 'sale'):?> 
							<span class="tag font-montserrat sale"><?php esc_html_e('FOR SALE', SH_NAME);?></span>
						<?php endif;?>
						<?php if(sh_set($property_meta, 'property_status') == 'rent'):?> 
							<span class="tag font-montserrat rent"><?php esc_html_e('FOR RENT', SH_NAME);?></span>
						<?php endif;?>
						
						<section> 
							<!--======= IMAGE =========-->
							<div class="img"> 
								<?php the_post_thumbnail('370x230', array('class' => 'img-responsive'));?>
								<!--======= IMAGE HOVER =========-->

								<div class="over-proper"> <a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>" class="btn font-montserrat"><?php esc_html_e('more details', SH_NAME);?></a> </div>
							</div>
							<!--======= HOME INNER DETAILS =========-->
							<ul class="home-in">

								<?php if( $pro_info = sh_set($property_meta, 'area') ): ?>
									<li><span><i class="fa fa-home"></i><?php echo balanceTags($pro_info);?></span></li>
								<?php endif ;?>
								<?php if( $pro_info = sh_set($property_meta, 'bedrooms') ): ?>
									<li><span><i class="fa fa-bed"></i> <?php echo balanceTags($pro_info);?></span></li>
								<?php endif; ?>
								<?php if( $pro_info = sh_set($property_meta, 'bathrooms') ): ?>
									<li><span><i class="fa fa-tty"></i> <?php echo balanceTags($pro_info);?></span></li>
								<?php endif; ?>
							</ul>
							
							<!--======= HOME DETAILS =========-->
							<div class="detail-sec"> <a href="<?php the_permalink();?>" class="font-montserrat"><?php the_title();?></a> <span class="locate"><i class="fa fa-map-marker"></i><?php echo sh_set($property_meta, 'address');?></span>
								<p><?php echo _sh_trim(get_the_content(), $text_limit);?></p>
								<div class="share-p"> 
									<span class="price font-montserrat"><?php echo sh_set($property_meta, 'price');?></span> 
									<a href="javascript:;" data-id="<?php the_ID(); ?>" class="add_to_wishlist"><i class="fa fa-star-o"></i></a>
									<a href="javascript:void(0);" class="share-this-btn" title="Share This"><i class="fa fa-share-alt st_sharethis_large"></i></a>
								</div>
							</div>
						
						</section>
					</li>

				<?php endwhile;?>

			</ul>
		</div>
	</section>
	
	<script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "e5f231e9-4404-49b7-bc55-0e8351a047cc", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<?php endif;?>

<?php wp_reset_postdata();
return ob_get_clean();