<?php  
ob_start() ;?>

<!--======= CONTACT INFORMATION =========-->
<div class="contact-info">
	<div class="container"> 
		<!--======= CONTACT =========-->
		<ul class="row con-det">

			<!--======= ADDRESS =========-->
			<li class="col-md-4"> <i class="fa fa-map-marker"></i>
				<?php echo sh_vc_content_decode($text);?>
			</li>

			<!--======= EMAIL =========-->
			<li class="col-md-4"> <i class="fa fa-phone"></i>
				<?php if($telephone):?><p><?php esc_html_e('Tel  :  ', SH_NAME); echo balanceTags($telephone);?></p><?php endif;?>
				<?php if($fax):?><p><?php esc_html_e('fax  :  ', SH_NAME); echo balanceTags($fax);?></p><?php endif;?>
			</li>

			<!--======= ADDRESS =========-->
			<li class="col-md-4"> <i class="fa fa-clock-o"></i>
				<?php echo sh_vc_content_decode($text2);?>
			</li>
		</ul>

		<!--======= CONTACT FORM =========--> 

	</div>
</div>

<?php return ob_get_clean();