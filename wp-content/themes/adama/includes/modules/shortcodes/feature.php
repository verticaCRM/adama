<?php  
ob_start() ;?>

<!--======= MOBILE APP =========-->
<section class="mobile-app">
	<div class="container">
		<div class="row">
			<div class="col-md-6"> <img class="img-responsive" src="<?php echo wp_get_attachment_url($img, 'full');?>" alt=""> </div>
			<div class="col-md-6">
				<h3><?php echo balanceTags($title);?></h3>
				<hr>
				<?php echo apply_filters('the_content', balanceTags($contents, true) );?>
				<a href="<?php echo esc_url($btn_link);?>" class="btn"><?php echo balanceTags($btn_text);?></a> 
			</div>
		</div>
	</div>
</section>

<?php return ob_get_clean();