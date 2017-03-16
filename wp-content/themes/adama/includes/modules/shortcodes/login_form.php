<?php
ob_start();
?>

<!--======= LOGIN SECTION =========-->
<div class="regi-sec">
	
	<span class="regi-tag"><?php echo balanceTags($title);?></span>
	<?php if( !is_user_logged_in() ): ?>
		<form action="<?php echo home_url(); ?>/wp-login.php" method="post" id="loginform" class="form form-register">
			<ul>
				<li>
					<label><?php esc_html_e('Username', SH_NAME);?>
						<input type="text" name="log" id="log" required >
					</label>
				</li>
				<li>
					<label><?php esc_html_e('password', SH_NAME);?>
						<input type="password" name="pwd" id="pwd" required >
					</label>
				</li>
				<li>
					<button type="submit" class="btn"><?php esc_html_e('LOGIN', SH_NAME);?></button>
					<a href="#." class="forget"><?php esc_html_e('Forgot Password?', SH_NAME);?></a> 
				</li>
			</ul>
		</form>
	<?php else: ?>

		<a href="<?php echo wp_logout_url(home_url()); ?>" title="<?php esc_html_e('Logout', SH_NAME); ?>" class="btn btn-primary"><?php esc_html_e('Logout', SH_NAME); ?></a>				

	<?php endif; ?>

</div>

<?php return ob_get_clean();?>		