<?php
// Subscribe
class SH_NewsLetter extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_NewsLetter', /* Name */__('Preshop News Letter',SH_NAME), array( 'description' => __('News Letter', SH_NAME )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		?>
			<?php echo $before_title.$title.$after_title;?>
		<div class="newsletter_form clearfix"> 
            <p><?php echo $instance['newsleter_text']; ?></p>  
            <form target="popupwindow" method="post" id="subscribe" action="http://feedburner.google.com/fb/a/mailverify" accept-charset="utf-8"  class="form-inline" role="form">
                <div class="form-group">
                    <label for="newsletter_input" class="sr-only"><?php _e("Subscribe to Newsletter" , SH_NAME);?></label>
                    <input type="text" class="form-control" name="email" id="newsletter_input" placeholder="<?php _e("Enter your email" , SH_NAME);?>">
               		<input type="hidden" id="uri" name="uri" value="<?php echo $instance['ID']; ?>">
					<input type="hidden" value="en_US" name="loc">
                </div>
                <button type="submit" id="submit" class="btn btn-primary"><?php _e("GO" , SH_NAME);?></button>
            </form>
        </div>
        
		<?php
		echo $after_widget;
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['ID'] = $new_instance['ID'];
		$instance['newsleter_text'] = $new_instance['newsleter_text'];
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Subscribe', SH_NAME);
		$ID = ($instance) ? esc_attr($instance['ID']) : 'themeforest';
		$newsleter_text	= ($instance) ? esc_attr($instance['newsleter_text']) : '';
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
       	<p>
            <label for="<?php echo $this->get_field_id('ID'); ?>"><?php _e('Feedburner ID:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('ID'); ?>" name="<?php echo $this->get_field_name('ID'); ?>" type="text" value="<?php echo esc_attr($ID); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('newsleter_text') ); ?>"><?php _e('Text :', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('newsleter_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('newsleter_text') ); ?>" type="text" value="<?php echo esc_attr( $newsleter_text ); ?>" />
        </p>       
		<?php 
	}
}
// Social Media
class SH_SocialMedia extends WP_Widget
{
	/** constructor */
	
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_SocialMedia', /* Name */__('Preshop Social Media',SH_NAME), array( 'description' => __('Social Media', SH_NAME )) );
	}
	
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		//$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		?>
		<?php //echo $before_title.$title.$after_title;?>
            
            <span class="social-icons">
                <a href="<?php echo $instance['facebook']; ?>" title=""><i class="icon-facebook"></i></a>
                <a href="<?php echo $instance['twitter']; ?>" title=""><i class="icon-twitter"></i></a>
                <a href="<?php echo $instance['gplus']; ?>" title=""><i class="icon-gplus"></i></a>
                <a href="<?php echo $instance['pinterest']; ?>" title=""><i class="icon-pinterest"></i></a>
                <a href="<?php echo $instance['youtube']; ?>" title=""><i class="icon-youtube"></i></a>
                <a href="<?php echo $instance['yelp']; ?>" title=""><i class="icon-yelp"></i></a>
                <a href="<?php echo $instance['blogger']; ?>" title=""><i class="icon-blogger"></i></a>
                <a href="<?php echo $instance['deviantart']; ?>" title=""><i class="icon-deviantart"></i></a>
            </span><!-- end social -->
		<?php
         echo $after_widget;
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['facebook'] = $new_instance['facebook'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['gplus'] = $new_instance['gplus'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['yelp'] = $new_instance['yelp'];
		$instance['blogger'] = $new_instance['blogger'];
		$instance['deviantart'] = $new_instance['deviantart'];
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{	
		$facebook		= ($instance) ? esc_attr($instance['facebook']) : 'https://www.facebook.com/';
		$twitter 		= ($instance) ? esc_attr($instance['twitter']) : 'https://www.twitter.com/';
		$gplus 			= ($instance) ? esc_attr($instance['gplus']) : 'https://www.googleplus.com/';
		$pinterest 		= ($instance) ? esc_attr($instance['pinterest']) : 'https://www.pinterest.com/';
		$youtube		= ($instance) ? esc_attr($instance['youtube']) : 'https://www.youtube.com/';
		$yelp 			= ($instance) ? esc_attr($instance['yelp']) : 'https://www.yelp.com/';
		$blogger		= ($instance) ? esc_attr($instance['blogger']) : 'https://www.blogger.com/';
		$deviantart		= ($instance) ? esc_attr($instance['deviantart']) : 'https://www.deviantart.com/';
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>"><?php _e('Facebook:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name('facebook') ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
        </p>       
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>"><?php _e('Twitter:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter') ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('gplus') ); ?>"><?php _e('Google Plus:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('gplus') ); ?>" name="<?php echo esc_attr( $this->get_field_name('gplus') ); ?>" type="text" value="<?php echo esc_attr( $gplus ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>"><?php _e('Pinterest:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pinterest') ); ?>" type="text" value="<?php echo esc_attr( $pinterest ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('youtube') ); ?>"><?php _e('Youtube:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('youtube') ); ?>" name="<?php echo esc_attr( $this->get_field_name('youtube') ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yelp') ); ?>"><?php _e('Yelp:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('yelp') ); ?>" name="<?php echo esc_attr( $this->get_field_name('yelp') ); ?>" type="text" value="<?php echo esc_attr( $yelp ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('blogger') ); ?>"><?php _e('Blogger:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('blogger') ); ?>" name="<?php echo esc_attr( $this->get_field_name('blogger') ); ?>" type="text" value="<?php echo esc_attr( $blogger ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('deviantart') ); ?>"><?php _e('Deviantart:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('deviantart') ); ?>" name="<?php echo esc_attr( $this->get_field_name('deviantart') ); ?>" type="text" value="<?php echo esc_attr( $deviantart ); ?>" />
        </p>
        
		<?php 
	}
}
// Account
class SH_Account extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Account', /* Name */__('Preshop Accounts For Payment',SH_NAME), array( 'description' => __('Preshop Account', SH_NAME )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		//$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		?>
			<?php //echo $before_title.$title.$after_title;?>
            <span class="payment-method">
            	<?php if ( $instance['paypal'] ):?>
                <i class="icon-cc-paypal"></i>
                <?php endif; ?>
                
                <?php if ( $instance['visa'] ):?>
                <i class="icon-cc-visa"></i>
                <?php endif; ?>
                
                <?php if ( $instance['mastercard'] ):?>
                <i class="icon-cc-mastercard"></i>
                <?php endif; ?>
                
                <?php if ( $instance['stripe'] ):?>
                <i class="icon-cc-stripe"></i>
                <?php endif; ?>
                
                <?php if ( $instance['amex'] ):?>
                <i class="icon-cc-amex"></i>
                <?php endif; ?>
            </span>
		<?php
		echo $after_widget;
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['paypal'] = $new_instance['paypal'];
		$instance['visa'] = $new_instance['visa'];
		$instance['mastercard'] = $new_instance['mastercard'];
		$instance['stripe'] = $new_instance['stripe'];
		$instance['amex'] = $new_instance['amex'];
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{	
		$paypal			= ($instance) ? esc_attr($instance['paypal']) : '';
		$visa 			= ($instance) ? esc_attr($instance['visa']) : '';
		$mastercard 	= ($instance) ? esc_attr($instance['mastercard']) : '';
		$stripe 		= ($instance) ? esc_attr($instance['stripe']) : '';
		$amex 			= ($instance) ? esc_attr($instance['amex']) : '';
		?>
        
        <p>
        	<?php $checked = ($paypal) ? ' checked="checked"': '';?>
            <label for="<?php echo esc_attr( $this->get_field_id('paypal') ); ?>"><?php _e('Paypal:', SH_NAME); ?></label>
            <input class="widefat" <?php echo $checked;?> id="<?php echo esc_attr( $this->get_field_id('paypal') ); ?>" name="<?php echo esc_attr( $this->get_field_name('paypal') ); ?>" type="checkbox" value="true" value="<?php //echo esc_attr( $paypal ); ?>" />
        </p>   
        <p>
        	<?php $checked = ($visa) ? ' checked="checked"': '';?>
            <label for="<?php echo esc_attr( $this->get_field_id('visa') ); ?>"><?php _e('Visa:', SH_NAME); ?></label>
            <input class="widefat" <?php echo $checked;?> id="<?php echo esc_attr( $this->get_field_id('visa') ); ?>" name="<?php echo esc_attr( $this->get_field_name('visa') ); ?>" type="checkbox" value="true" />
        </p>
        <p>
        	<?php $checked = ($mastercard) ? ' checked="checked"': '';?>
            <label for="<?php echo esc_attr( $this->get_field_id('mastercard') ); ?>"><?php _e('Mastercard:', SH_NAME); ?></label>
            <input class="widefat" <?php echo $checked;?> id="<?php echo esc_attr( $this->get_field_id('mastercard') ); ?>" name="<?php echo esc_attr( $this->get_field_name('mastercard') ); ?>" type="checkbox" value="true" />
        </p>
        <p>
        	<?php $checked = ($stripe) ? ' checked="checked"': '';?>
            <label for="<?php echo esc_attr( $this->get_field_id('stripe') ); ?>"><?php _e('Stripe:', SH_NAME); ?></label>
            <input class="widefat" <?php echo $checked;?> id="<?php echo esc_attr( $this->get_field_id('stripe') ); ?>" name="<?php echo esc_attr( $this->get_field_name('stripe') ); ?>" type="checkbox" value="true" />
        </p>
        <p>
        	<?php $checked = ($amex) ? ' checked="checked"': '';?>
            <label for="<?php echo esc_attr( $this->get_field_id('amex') ); ?>"><?php _e('Amex:', SH_NAME); ?></label>
            <input class="widefat" <?php echo $checked;?> id="<?php echo esc_attr( $this->get_field_id('amex') ); ?>" name="<?php echo esc_attr( $this->get_field_name('amex') ); ?>" type="checkbox" value="true" />
        </p>        
		<?php 
	}
}
// Social Profile
class SH_SocialProfile extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_SocialProfile', /* Name */__('Pretty Social Profile',SH_NAME), array( 'description' => __('Social Profile', SH_NAME )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		?>
			<?php echo $before_title.$title.$after_title;?>
        	<ul> 
            	<li><a href="<?php echo esc_url( $instance['facebook_url'] ); ?>" title=""><?php _e('Women Shoes ',SH_NAME);?> <span><?php echo $instance['fb_num']; ?></span></a></li>
            	<li><a href="<?php echo esc_url( $instance['twitter_url'] ); ?>" title=""><?php _e('Special Offers ',SH_NAME);?> <span><?php echo $instance['tw_num']; ?></span></a></li>
            	<li><a href="<?php echo esc_url( $instance['googleplus_url'] ); ?>" title=""><?php _e('Shopping Mall ',SH_NAME);?> <span><?php echo $instance['gp_num']; ?></span></a></li>
            	<li><a href="<?php echo esc_url( $instance['instagram_url'] ); ?>" title=""><?php _e('Guess You Like ',SH_NAME);?> <span><?php echo $instance['instagram_url']; ?></span></a></li>
            	<li><a href="<?php echo esc_url( $instance['pinterest_url'] ); ?>" title=""><?php _e('Warehouse ',SH_NAME);?> <span><?php echo $instance['pin_num']; ?></span></a></li>
            </ul>    
		<?php
		echo $after_widget;
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['facebook_url'] = strip_tags($new_instance['facebook_url']);
		$instance['fb_num'] = strip_tags($new_instance['fb_num']);
		$instance['twitter_url'] = strip_tags($new_instance['twitter_url']);
		$instance['tw_num'] = strip_tags($new_instance['tw_num']);
		
		$instance['googleplus_url'] = strip_tags($new_instance['googleplus_url']);
		$instance['gp_num'] = strip_tags($new_instance['gp_num']);
		$instance['instagram_url'] = strip_tags($new_instance['instagram_url']);
		
		$instance['ins_num'] = strip_tags($new_instance['ins_num']);
		$instance['pinterest_url'] = strip_tags($new_instance['pinterest_url']);
		$instance['pin_num'] = strip_tags($new_instance['pin_num']);
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Social Profiles', SH_NAME);
		$facebook = ($instance) ? esc_attr($instance['facebook_url']) : 'http://www.facebook.com';
		$facebook_num = ($instance) ? esc_attr($instance['fb_num']) : '2221';
		$twitter = ($instance) ? esc_attr($instance['twitter_url']) : 'http://www.twitter.com';
		$twitter_num = ($instance) ? esc_attr($instance['tw_num']) : '5312';
		$googleplus = ($instance) ? esc_attr($instance['googleplus_url']) : 'http://www.googleplus.com';
		$googleplus_num = ($instance) ? esc_attr($instance['gp_num']) : '443';
		$instagram = ($instance) ? esc_attr($instance['instagram_url']) : 'http://www.instagram.com';
		$instagram_num = ($instance) ? esc_attr($instance['ins_num']) : '12234';
		$pinterest = ($instance) ? esc_attr($instance['pinterest_url']) : 'http://www.pinterest.com';
		$pinterest_num = ($instance) ? esc_attr($instance['pin_num']) : '212';
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('facebook_url') ); ?>"><?php _e('Facebook URL:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('facebook_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('facebook_url') ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id('fb_num') ); ?>"><?php _e('Facebook Number:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('fb_num') ); ?>" name="<?php echo esc_attr( $this->get_field_name('fb_num') ); ?>" type="text" value="<?php echo esc_attr( $facebook_num ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id('twitter_url') ); ?>"><?php _e('Twitter URL:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter_url') ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id('tw_num') ); ?>"><?php _e('Twitter Number:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('tw_num') ); ?>" name="<?php echo esc_attr( $this->get_field_name('tw_num') ); ?>" type="text" value="<?php echo esc_attr( $twitter_num ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id('googleplus_url') ); ?>"><?php _e('Google Plus URL:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('googleplus_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('googleplus_url') ); ?>" type="text" value="<?php echo esc_attr( $googleplus ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id('gp_num') ); ?>"><?php _e('Google Plus Number:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('gp_num') ); ?>" name="<?php echo esc_attr( $this->get_field_name('gp_num') ); ?>" type="text" value="<?php echo esc_attr( $googleplus_num ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id('instagram_url') ); ?>"><?php _e('Instagram URL:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('instagram_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('instagram_url') ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id('ins_num') ); ?>"><?php _e('Instagram Number:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('ins_num') ); ?>" name="<?php echo esc_attr( $this->get_field_name('ins_num') ); ?>" type="text" value="<?php echo esc_attr( $instagram_num ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id('pinterest_url') ); ?>"><?php _e('Pinterest URL:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pinterest_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pinterest_url') ); ?>" type="text" value="<?php echo esc_attr( $pinterest ); ?>" />
        </p>
		<p>
          	 <label for="<?php echo esc_attr( $this->get_field_id('pin_num') ); ?>"><?php _e('Pinterest Number:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pin_num') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pin_num') ); ?>" type="text" value="<?php echo esc_attr( $pinterest_num ); ?>" />
        </p>
		<?php 
	}
}
// Contact Number
class SH_ContactNumber extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_ContactNumber', /* Name */__('Preshop Contact Number',SH_NAME), array( 'description' => __('contact number', SH_NAME )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		?>
		<?php echo '<h3><i class="icon-phone"></i>'.$title.'</h3>'; ?>
            <p class="lead"><?php echo $instance['number']; ?></p>
			
		<?php
		echo $after_widget;
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Telephone', SH_NAME);
		$number = ($instance) ? esc_attr($instance['number']) : '(1005) 5999 4446';
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
       	<p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Contact Number:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
        </p>    
		<?php 
	}
}
// Address
class SH_Address extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Address', /* Name */__('Preshop Address',SH_NAME), array( 'description' => __('Address', SH_NAME )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;?>
		<?php echo '<h3><i class="icon-phone"></i>'.$title.'</h3>'; ?>
            
            <p class="lead"><?php echo $instance['address_text']; ?></p>
			
		<?php echo $after_widget;
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['address_text'] = strip_tags($new_instance['address_text']);
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
			   $title = ($instance) ? esc_attr($instance['title']) : __('Address', SH_NAME);
		$address_text = ($instance) ? esc_attr($instance['address_text']) : '8121 King Street, Melbourne Victoria 3000
United States of America, CA 90017';
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
       	<p>
            <label for="<?php echo $this->get_field_id('address_text'); ?>"><?php _e('Address:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('address_text'); ?>" name="<?php echo $this->get_field_name('address_text'); ?>" type="text" value="<?php echo esc_attr($address_text); ?>" />
        </p>    
		<?php 
	}
}
// Email
class SH_Email extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Email', /* Name */__('Preshop email',SH_NAME), array( 'description' => __('Email', SH_NAME )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;?>
		<?php echo '<h3><i class="icon-phone"></i>'.$title.'</h3>'; ?>
            
                        <p class="lead"><?php echo $instance['email_text']; ?></p>
			
		<?php echo $after_widget;
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['email_text'] = strip_tags($new_instance['email_text']);
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Email', SH_NAME);
		$email_text = ($instance) ? esc_attr($instance['email_text']) : 'support@jollythemes.com';
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        
       	<p>
            <label for="<?php echo $this->get_field_id('email_text'); ?>"><?php _e('Email:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('email_text'); ?>" name="<?php echo $this->get_field_name('email_text'); ?>" type="text" value="<?php echo esc_attr($email_text); ?>" />
        </p>    
		<?php 
	}
}
/// Posts Tabber
class SH_New_Items extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_New_Items', /* Name */__('Preshop New Items ',SH_NAME), array( 'description' => __('New items with images', SH_NAME )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $before_widget;
		
		echo $before_title.$title.$after_title; 
		
		$query_string = 'posts_per_page='.$instance['number'].'&post_type=product';
		if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
		query_posts( $query_string ); 
	
		$this->posts();
		wp_reset_query(); 
		
		echo $after_widget;
	}
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : __('Recent Posts', SH_NAME);
		$number = ( $instance ) ? esc_attr($instance['number']) : 4;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('No. of Posts:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
       
        <p>
            <label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Category', SH_NAME); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>__('All Categories', SH_NAME), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
        
		<?php 
	}
	
	function posts()
	{
		if( have_posts() ):?>
        <?php $count = 0; ?>
        
        <div class="featured-posts row woocommerce">
        	<div class="col-md-6">
        		<ul>
                <?php while( have_posts() ): the_post(); ?>
                <?php if(($count%2) == 0 && $count != 0): ?>
   					</ul></div><div class="col-md-6"><ul>
  					<?php endif; ?>
                 <li>
                 
                    <div class="alignleft">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('160x180', array('class'=>'img-responsive img-thumbnail'));?></a>
                    </div>
                    <h4><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <div class="meta">
                            <?php woocommerce_template_loop_rating(); ?>
                    </div><!-- end meta -->
                <a class="readmore" href="<?php the_permalink(); ?>" title=""><?php _e('View Item', SH_NAME); ?></a>
           	 </li>
           <?php $count++; endwhile; ?>     
    
            </ul>
        </div>
    </div>
            
		<?php endif;
    }

}
