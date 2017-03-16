<?php
	global $bbcrm_option;
?>
<div class="top-bar" id='divA'>
	<ul class="left-bar-side theme-color1-lt">
		<?php if($bbcrm_option["bbcrm_contactus_showhide"]): ?>
			<li id="contactusli"><a class="" href="<?php echo get_permalink($bbcrm_option['bbcrm_loginbar_contactus']);?>"><i class="fa fa-envelope"></i> <?php _e('Contact Us','bbcrm');?> </a><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span></li>
		<?php endif; ?>
		<?php if($bbcrm_option["bbcrm_phone_showhide"]): ?>
			<li id="contactusli"><a class="" href="tel:<?php echo $bbcrm_option['bbcrm_loginbar_phone']; ?>"><i class="fa fa-phone"></i> <?php echo $bbcrm_option['bbcrm_loginbar_phone'];  ?> </a><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span></li>
		<?php endif; ?>
		<?php if($bbcrm_option["bbcrm_fax_showhide"]): ?>
			<li id="contactusli"><a class="" href="tel:<?php echo $bbcrm_option['bbcrm_loginbar_fax']; ?>" ><i class="fa fa-fax"></i> <?php echo $bbcrm_option['bbcrm_loginbar_fax'];  ?> </a><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span></li>
		<?php endif; ?>

     <?php if($bbcrm_option["bbcrm_email_showhide"]): ?>
		<li id="contactusli"><a class="" href="mailto:<?php echo $bbcrm_option['bbcrm_loginbar_email'];  ?>" ><i class="fa fa-envelope-o"></i> <?php echo $bbcrm_option['bbcrm_loginbar_email'];  ?> </a><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span></li> 	
	<?php endif; ?>

	<?php if(!is_user_logged_in() ): ?>
		<li><a class="" href="<?php echo get_permalink($bbcrm_option["bbcrm_pages_registration"]);?>"><i class="fa  fa-plus-circle"></i> <?php _e('Member Registration','bbcrm');?> </a> <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span></li>
		<li id="loginli"><a href="#" class="loginlink "><i class="fa fa-lock"></i> <?php _e('Buyer Login','bbcrm');?> </a><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span></li>
<div class="" id="logindiv"><?php 
$args = array(
	'form_id' => 'headerloginform',
	'remember' => false,
	 'value_remember' => false,
	 'redirect' => get_permalink($bbcrm_option['bbcrm_loginbar_dataroom']) ,
'label_username' => __( 'Email Address' , 'bbcrm' ),
	'label_password' => __( 'Password' , 'bbcrm' ),
	'label_remember' => __( 'Remember Me' , 'bbcrm' ),
	'label_log_in'   => __( 'Log In' , 'bbcrm'),
	);
wp_login_form($args); ?>
<script>jQuery("#wp-submit").addClass('theme-background1-lt').css('border','none')</script>
</div>

<li><a class="" href="<?php echo wp_lostpassword_url(); ?>"><i class="fa  fa-question"></i> <?php _e('Forgot Password', 'bbcrm');?> </a><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span></li>
	 	<?php else: ?>
	 	<li><a class="" href="<?php echo get_permalink($bbcrm_option['bbcrm_loginbar_dataroom']);?>"><i class="fa fa-building-o"></i> <?php echo __('Your','bbcrm')." ".get_the_title($bbcrm_option['bbcrm_loginbar_dataroom']);?> </a><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span></li>
	 	<li><a class="" href="<?php echo get_permalink($bbcrm_option['bbcrm_pages_buyerprofile']);?>"><i class="fa fa-user"></i> <?php _e('Your Profile','bbcrm');?> </a><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span></li>
	 	<li><a class="" href="<?php echo wp_logout_url('/'); ?>"><i class="fa fa-arrow-circle-o-right"></i> <?php _e('Log Out','bbcrm');?> </a></li>	
		<?php endif; ?>		
      </ul> 
</div>
     <script>
     jQuery(document).ready(function(){
	jQuery(".loginlink").click(function(event){
	event.preventDefault();
	jQuery("#logindiv").css('display','inline-block');jQuery("#loginli").hide();})
     });     
     </script>
