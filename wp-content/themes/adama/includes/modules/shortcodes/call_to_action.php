<?php  
ob_start() ;?>

<!--======= CALL US =========-->

<section class="call-us">
	<div class="overlay">
		<div class="container">
			<ul class="row">
				<li class="col-sm-6">
					<h4><?php echo balanceTags($title);?></h4>
					<h6><?php echo balanceTags($subtitle);?></h6>
				</li>
				<li class="col-sm-4">
					<h1><?php echo balanceTags($phone);?></h1>
				</li>
				<li class="col-sm-2 no-padding"> <a href="<?php echo esc_url($btn_link);?>" class="btn"><?php echo balanceTags($btn_text);?></a> </li>
			</ul>
		</div>
	</div>
</section>

<?php return ob_get_clean();