<?php ob_start(); ?>
<?php
$settings  = _WSH()->option();
$top_heading_img= get_template_directory_uri()."/images/head-top.png";
$top_heading_img = sh_set( $settings, 'top_heading_img' ) ? sh_set( $settings, 'top_heading_img' ) : $top_heading_img;

?>
<!--======= PROPERTY =========-->
<section class="pricing">
	<div class="container"> 
		
		<!--======= TITTLE =========-->
		<div class="tittle"> <img src="<?php  echo $top_heading_img;  ?>" alt="">
			<h3><?php echo balanceTags($title);?></h3>
			<p><?php echo balanceTags($text)?></p>
		</div>
		
		<!--======= PLAN ROW =========-->
		<ul class="row">
			<?php echo do_shortcode( $contents );?>
		</ul>

	</div>
</section>

<?php return ob_get_clean(); ?>