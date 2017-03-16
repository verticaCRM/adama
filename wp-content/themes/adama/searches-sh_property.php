<?php global $query_string;

$location = sh_set( $_GET, 'location' );
$city = sh_set( $_GET, 'search_city' );
$status = sh_set( $_GET, 'property_status' );
$type = sh_set( $_GET, 'property_type' );
$beds = sh_set( $_GET, 'property_bedrooms' );
$baths = sh_set( $_GET, 'property_bathrooms' );
$min = str_replace('$', '', sh_set( $_GET, 'min_price' ) );
$max = str_replace('$', '', sh_set( $_GET, 'max_price' ) );

$args = array( 'post_type' => 'sh_property' );
$meta_query = array();
if( $location ) $meta_query[] = array('key'=> '_sh_address', 'value' => $location, 'compare' => 'LIKE' );
if( $status ) $meta_query[] = array('key'=> '_sh_property_status', 'value' => $status, 'compare' => '=' );
if( $type ) $meta_query[] = array('key'=> '_sh_property_type', 'value' => $type, 'compare' => '=' );
if( $beds ) $meta_query[] = array('key'=> '_sh_bedrooms', 'value' => $beds, 'compare' => '>=' );
if( $baths ) $meta_query[] = array('key'=> '_sh_bathrooms', 'value' => $baths, 'compare' => '>=' );
//if( $min ) $meta_query[] = array('key'=> '_sh_price', 'value' => $min, 'compare' => '>=' );
if( $max ) $meta_query[] = array('key'=> '_sh_price', 'value' => array( $min, $max ), 'type'=> 'numeric', 'compare' => 'BETWEEN' );

if( $meta_query ) $args['meta_query'] = $meta_query;
if( $meta_query ) $args['meta_query']['relation'] = 'AND';

if( $city ) $args['property_city'] = $city;

$query = new WP_Query( $args );
//printr($query);
?>

<?php if($query->have_posts()) :?>
 <?php while( $query->have_posts() ): $query->the_post();

	$property_meta = _WSH()->get_meta();?>

<li id="post-<?php the_ID(); ?>" <?php post_class('col-sm-6');?>>
	

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
		  
		<div class="over-proper"> <a href="<?php the_permalink();?>" class="btn font-montserrat"><?php esc_html_e('more details', SH_NAME);?></a> </div>
		</div>
		<!--======= HOME INNER DETAILS =========-->
		<ul class="home-in">
		  <li><span><i class="fa fa-home"></i> <?php echo sh_set($property_meta, 'area');?></span></li>
		  <li><span><i class="fa fa-bed"></i> <?php echo sh_set($property_meta, 'bedrooms');?></span></li>
		  <li><span><i class="fa fa-tty"></i> <?php echo sh_set($property_meta, 'bathrooms');?></span></li>
		</ul>
		<!--======= HOME DETAILS =========-->
		<div class="detail-sec"> <a href="<?php the_permalink();?>" class="font-montserrat"><?php the_title();?></a> <span class="locate"><i class="fa fa-map-marker"></i> <?php echo sh_set($property_meta, 'address');?></span>
		  <p><?php echo get_the_excerpt();?></p>
		  <div class="share-p"> <span class="price font-montserrat"><?php echo sh_set($property_meta, 'price');?></span> <i class="fa fa-star-o"></i> <i class="fa fa-share-alt"></i> </div>
		</div>
	</section>
	
</li>

<?php endwhile; ?>

<div class="text-center">
	<?php _the_pagination(array('total'=>$query->max_num_pages)); ?>
	<!-- /pagination --> 
</div>

<?php else: ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', SH_NAME ); ?></p>
		<?php get_search_form(); ?>
	
<?php endif; ?>