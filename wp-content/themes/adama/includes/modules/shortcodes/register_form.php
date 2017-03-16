<?php
   ob_start();
?>

<!--======= SIGN UP =========-->
  <div class="regi-sec">
  <span class="regi-tag"><?php echo balanceTags($title);?></span>
	<?php if( !is_user_logged_in() ): ?>
	<form action="<?php echo home_url(); ?>/wp-login.php?action=register" name="loginform" method="post" id="loginform1" class="form form-register" >
	  <ul>
		<li>
		  <label><?php esc_html_e('YOUR NAME', SH_NAME);?>
			<input type="text" name="user_login" id="user_login" required >
		  </label>
		</li>
		<li>
		  <label><?php esc_html_e('EMAIL', SH_NAME);?>
			<input type="email" name="user_email" id="user_email" required >
		  </label>
		</li>
		<li>
		  <label><?php esc_html_e('password', SH_NAME);?>
			<input type="password" name="pswd" required >
		  </label>
		</li>
		<li>
		  <button type="submit" name="wp-submit" class="btn"><?php esc_html_e('Signup', SH_NAME);?></button>
		  <div class="forget checkbox">
			<label>
			  <input type="checkbox">
			  <a href="#."><?php esc_html_e('I Agree with terms & Conditions', SH_NAME);?></a> </label>
		  </div>
		  <a href="#." class="forget trems"></a> </li>
	  </ul>
	</form>
	<?php else: ?>

    	<a href="<?php echo wp_logout_url(home_url()); ?>" title="<?php esc_html_e('Logout', SH_NAME); ?>" class="btn btn-primary"><?php esc_html_e('Logout', SH_NAME); ?></a>				

    <?php endif; ?>
  </div>

<?php return ob_get_clean();?>		