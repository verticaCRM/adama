<?php global $wp_query; //printr($wp_query);
get_header(); 
$settings  = _WSH()->option(); 
$bg = sh_set( $settings, 'property_archive_page_header_img' );
$title = sh_set( $settings, 'property_archive_page_header_title' );
$inner_title = sh_set( $settings, 'property_archive_page_inner_title' );
$description = sh_set( $settings, 'property_archive_page_description' );
$top_heading_img= get_template_directory_uri()."/images/head-top.png";
$top_heading_img = sh_set( $settings, 'top_heading_img' ) ? sh_set( $settings, 'top_heading_img' ) : $top_heading_img;
?>
<!--======= BANNER =========-->
<div class="sub-banner" <?php if($bg):?>style="background-image: url('<?php echo esc_url($bg); ?>');"<?php endif;?>>
<div class="overlay">
  <div class="container">
	<h1><?php if($title) echo  balanceTags( $title ); else wp_title('');?></h1>
	<ol class="breadcrumb">
	  <li class="pull-left"><?php if($title) echo  balanceTags( $title ); else wp_title('');?></li>
	  <?php echo get_the_breadcrumb();?>	
	</ol>
  </div>
</div>
</div>

<!--======= PROPERTY =========-->
<section class="properties white-bg">
<div class="container"> 
  
  <!--======= TITTLE =========-->
  <div class="tittle"> <img src="<?php  echo $top_heading_img;  ?>" alt="">
	<h3><?php echo balanceTags($inner_title);?></h3>
	<p><?php echo balanceTags($description);?></p>
  </div>
  
  <!--======= PROPERTIES ROW =========-->
  <ul class="row">
	
	<?php while( have_posts() ): the_post();
		  $property_meta = _WSH()->get_meta();
	?>

			
			<!--======= PROPERTY =========-->
			<li id="post-<?php the_ID(); ?>" <?php post_class('col-sm-4');?>> 
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
				  <div class="share-p"> 
				  	<span class="price font-montserrat"><?php echo sh_set($property_meta, 'price');?></span> 
				  	<a href="javascript:;" data-id="<?php the_ID(); ?>" class="add_to_wishlist"><i class="fa fa-star-o"></i></a>
					<a href="javascript:void(0);" class="share-this-btn" title="Share This"><i class="fa fa-share-alt st_sharethis_large"></i></a> 
				  </div>
				</div>
			  </section>
			</li>
			
	<?php endwhile; ?>

  </ul>
  <nav>
	<?php _the_pagination(); ?>
  </nav>
</div>
</section>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "e5f231e9-4404-49b7-bc55-0e8351a047cc", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<?php get_footer(); ?>