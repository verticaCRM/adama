<?php ob_start(); 
wp_enqueue_script( array('jquery-jigowatt') );?>

<section class="content clearfix">
    <div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="post-preview text-center clearfix">
                <?php if($small_title):?>
                	<small><?php echo $small_title;?></small>
                <?php endif;?>
                <?php if($main_title):?>
                    <a title="" href="<?php echo $title_link;?>">
                        <h2 class="post-title"><?php echo $main_title; ?></h2>
                    </a>
                <?php endif;?>
                <?php if($tagline):?>   
                	<p class="post-meta"><?php echo urldecode( base64_decode( $tagline ));?></p>
				<?php endif;?>
                <div class="desc">
                    <?php echo urldecode( base64_decode( $content ));?>

				<div class="contact-widget clearfix">
                    <div id="response_message"></div>
                    <form id="comments_form" action="<?php echo admin_url( 'admin-ajax.php?action=_sh_ajax_callback&amp;subaction=contact_form_submit'); ?>" name="contactform" method="post">
                            <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="<?php _e('Your name', SH_NAME);?>"> 
                            <input type="text" name="contact_website" id="contact_website" class="form-control" placeholder="<?php _e('Your website', SH_NAME);?>"> 
                            <input type="text" name="contact_email" id="contact_email" class="form-control" placeholder="<?php _e('Your email', SH_NAME);?>"> 
                            <input type="text" name="contact_subject" id="contact_subject" class="form-control" placeholder="<?php _e('How can I help?', SH_NAME);?>"> 
                            <textarea class="form-control" name="contact_message" id="contact_message" rows="6" placeholder="<?php _e('Message goes here...', SH_NAME);?>"></textarea>
                            <input type="submit" value="<?php _e('Send Message', SH_NAME);?>" id="submit" class="pull-left btn btn-primary">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" class="loader1" style="display:none;" />
                    </form>
               </div>

                </div><!-- end desc -->
            </div><!-- end post-preview -->
        </div><!-- end col-lg-8 -->
    </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end content -->

<?php return ob_get_clean(); ?>