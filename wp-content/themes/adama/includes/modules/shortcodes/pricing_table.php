<?php ob_start(); 
$count = 1;
?>

<!--======= PALAN 2 =========-->
<li class="col-md-3 col-sm-6">
	<h6><?php echo balanceTags($title);?></h6>
	<div class="price-head font-montserrat"> <span class="curency"><?php echo balanceTags($currency);?></span><?php echo balanceTags($price);?><span class="month"><?php echo balanceTags($package_duration);?></span> </div>
	<?php $features = explode("\n",$feature_str);?>
	<div class="p-details">
		<?php foreach($features as $feature):?>
			<p <?php if($count%2 == 0) echo 'class="gry-bg"';?>><?php echo balanceTags($feature);?></p>
			<?php $count++; 
		endforeach;?>
		
		<a href="<?php echo esc_url($btn_link);?>" class="font-montserrat"><?php echo balanceTags($btn_text);?> <i class="fa fa-long-arrow-right"></i></a> 
	</div>
</li>

<?php return ob_get_clean(); 