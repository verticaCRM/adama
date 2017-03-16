<?php
ob_start();
$mail_salt = function_exists('_sh_generate_salt' ) ? _sh_generate_salt( $email ) : $email;
$settings  = _WSH()->option();
$top_heading_img= get_template_directory_uri()."/images/head-top.png";
$top_heading_img = sh_set( $settings, 'top_heading_img' ) ? sh_set( $settings, 'top_heading_img' ) : $top_heading_img;
?>

<div class="contact-form">
	<div class="container"> 

		<!--======= TITTLE =========-->
		<div class="tittle"> <img src="<?php  echo $top_heading_img;  ?>" alt="">
			<h3><?php echo balanceTags($title);?></h3>
			<p><?php echo balanceTags($text);?></p>
		</div>
		<div id="message"></div>
		<form role="form" id="contact_form" method="post" action="<?php echo admin_url( 'admin-ajax.php?action=_sh_ajax_callback&amp;subaction=contact_form_submit'); ?>" name="contactForm">
			<ul class="row">
				<li class="col-sm-6">
					<label class="font-montserrat"><?php esc_html_e('your name *', SH_NAME);?>
						<input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="">
					</label>
				</li>
				<li class="col-sm-6">
					<label class="font-montserrat"><?php esc_html_e('your e-mail *', SH_NAME);?>
						<input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="">
					</label>
				</li>
				<li class="col-sm-6">
					<label class="font-montserrat"><?php esc_html_e('Phone *', SH_NAME);?>
						<input type="text" class="form-control" name="contact_company" id="contact_company" placeholder="">
					</label>
				</li>
				<li class="col-sm-6">
					<label class="font-montserrat"><?php esc_html_e('Subject');?>
						<input type="text" class="form-control" name="contact_subject" id="contact_subject" placeholder="">
					</label>
				</li>
				<li class="col-sm-12">
					<label class="font-montserrat"><?php esc_html_e('message', SH_NAME);?>
						<textarea class="form-control" name="contact_message" id="contact_message" rows="5" placeholder=""></textarea>
					</label>
				</li>
				<li class="col-sm-12">
					<input type="hidden" name="receiver_email" id="receiver_email" value="<?php echo esc_attr( $mail_salt ); ?>"  />
					<button type="submit" value="submit" class="btn font-montserrat" id="btn_submit"><?php esc_html_e('Send message', SH_NAME);?></button>
				</li>
			</ul>
		</form>
	</div>
</div>

<?php return ob_get_clean();?>	