<?php  
$count = 1; 
$query_args = array('post_type' => 'sh_property' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
$data_atts = array('sort'=>$sort, 'order'=>$order, 'num'=>$num, 'cat'=>$cat, 'action'=>'_sh_ajax_callback', 'subaction'=>'properties', 'page'=>1);
if( $cat ) $query_args['property_category'] = $cat;
$query = new WP_Query($query_args) ; 
$settings  = _WSH()->option();
$top_heading_img= get_template_directory_uri()."/images/head-top.png";
$top_heading_img = sh_set( $settings, 'top_heading_img' ) ? sh_set( $settings, 'top_heading_img' ) : $top_heading_img;
ob_start() ;?>
<?php if( $query->have_posts() ):?>

	<!--======= PROPERTY =========-->
	<section class="properties white-bg">
		<div class="container"> 

			<!--======= TITTLE =========-->
			<div class="tittle"> <img src="<?php  echo $top_heading_img;  ?>" alt="">
				<h3><?php echo balanceTags($title);?></h3>
				<p><?php echo balanceTags($text);?></p>
			</div>

			<!--======= PROPERTIES ROW =========-->
			<ul class="row property3-shortcode">

				<?php while($query->have_posts()): $query->the_post();
	
					global $post ;
					$property_meta = _WSH()->get_meta(); 
					?>

					<!--======= PROPERTY =========-->
					<li class="col-md-4 col-sm-6"> 
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

			<?php if($btn_text):?>
				<div class="text-center"> <a data-nopost="<?php esc_html_e('No More Properties Found', SH_NAME); ?>" data-page="1" data-atts='<?php echo json_encode($data_atts); ?>' class="load-more font-montserrat" href="<?php echo esc_url($btn_link);?>"><?php echo balanceTags($btn_text);?></a> </div>
			<?php endif;?>

		</div>
	</section>

	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.properties a.load-more').on('click', function(e){
				e.preventDefault();

				var this_elem = this;
				var this_text = $(this).text();
				var data_atts = $(this).data('atts');
				var page = $(this).data('page');
				var alt_text = $(this).data('nopost');
				
				if( page === 0 ) {
					$(this).text(alt_text);
					return false;
				}

				data_atts.page = page;
				$(this).html('<i class="fa fa-spinner fa-spin"></i>');

				$.ajax({
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'POST',
					data: data_atts,
					success: function(res){
						$('.property3-shortcode').append(res);
						$(this_elem).html(this_text);

						var newpage = (res === '') ? 0 : parseInt(page) + 1;
						if(newpage === 0 ) {
							$(this_elem).html(alt_text);
						}
						
						$(this_elem).data('page', newpage );
					}
				});
			});
		});
	</script>

<?php endif;?>

<?php wp_reset_postdata();
return ob_get_clean();