<?php
class SH_Ajax
{
	
	function __construct()
	{
		add_action( 'wp_ajax__sh_ajax_callback', array( $this, 'ajax_handler' ) );
		add_action( 'wp_ajax_nopriv__sh_ajax_callback', array( $this, 'ajax_handler' ) );
	}
	
	function ajax_handler()
	{
		$method = sh_set( $_REQUEST, 'subaction' );
		if( method_exists( $this, $method ) ) $this->$method();
		
		exit;
	}
	
	function tweets()
	{
		if( !class_exists( 'Codebird' ) ) include_once( 'codebird.php' );
		$cb = new Codebird;
		$method = sh_set( $_POST, 'method' );
		
		$theme_options = _WSH()->option();
		//printr($theme_options);
		$api = sh_set($theme_options, 'twitter_api');
		$api_secret = sh_set($theme_options, 'twitter_api_secret');
		$token = sh_set($theme_options, 'twitter_token');
		$token_secret = sh_set($theme_options, 'twitter_token_Secret');
		if( !$api && $api_secret ) 
		{ 
			_e('Please provide tiwtter api information to fetch feed', SH_NAME);exit;
		}
		$cb->setConsumerKey($api, $api_secret);
		$cb->setToken($token, $token_secret);
		
		$reply = (array) $cb->statuses_userTimeline(array('count'=>sh_set( $_POST, 'number' ), 'screen_name'=>sh_set($_POST, 'screen_name')));
		if( isset( $reply['httpstatus'] ) ) unset( $reply['httpstatus'] );
		foreach( $reply as $k => $v ){
			
			//if( $k == 'httpstatus' ) continue;
			$time = human_time_diff( strtotime( sh_set( $v, 'created_at') ), current_time('timestamp') ) . __(' ago', SH_NAME);
			$text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', sh_set( $v, 'text'));
			if($_POST['template'] === 'lead' )
			{
				echo '<i class="fa fa-twitter"></i>'.$text.' <a href="#"> '.$time.'</a>' ;
			}
			else {
				echo 
				'<li><span></span><p>'.$text.' <a href="#">'.__(' about ', SH_NAME).$time.'</a></p></li>';
			}
		}
	}
	
	function like_it()
	{
		$post_id = sh_set( $_POST, 'data_id' );
		
		if( !$post_id ) exit(json_encode(array('code'=>'fail', 'msg'=>__('There is an errors occurred saving your vote', SH_NAME ) ) ) );
		
		$meta = (int)get_post_meta($post_id, '_sh_like_it', true);

		$new_value = $meta + 1;
		
		$res = update_post_meta( $post_id, '_sh_like_it', $new_value );

		if( $res ) exit(json_encode(array('code'=>'success', 'msg'=>__('Your vote is saved', SH_NAME ), 'value' => $new_value ) ) );
		else exit(json_encode(array('code'=>'fail', 'msg'=>__('There is an errors occurred saving your vote', SH_NAME ) ) ) );
		//else exit(json_encode(array('code'=>'fail', 'msg'=>__('Please login first to add the product to your Like list', SH_NAME ) ) ) );
	}
	
	function contact_form_submit()
	{
		if( !count( $_POST ) ) return;
	
		_load_plugins_class( 'validation', 'helpers', true );
		$t = $GLOBALS['_sh_base'];//printr($t);
		$settings = $t->option();
		
		$post_test = sh_set( $_POST, 'receiver_email' );
		$receiver_email  = sanitize_email( $post_test ) ? sanitize_email( $post_test ) : _sh_generate_salt( $post_test, true );
		/** set validation rules for contact form */
		$t->validation->set_rules('contact_name','<strong>'.__('Name', SH_NAME).'</strong>', 'required|min_length[4]|max_lenth[30]');
		
		//$t->validation->set_rules('aplus_l_name','<strong>'.__('Last Name', SH_NAME).'</strong>', 'required|min_length[4]|max_lenth[30]');
		$t->validation->set_rules('contact_email','<strong>'.__('Email', SH_NAME).'</strong>', 'required|valid_email');
		
		$t->validation->set_rules('contact_company','<strong>'.__('Company', SH_NAME).'</strong>');
		$t->validation->set_rules('contact_subject','<strong>'.__('Subject', SH_NAME).'</strong>');
		
		$t->validation->set_rules('contact_message','<strong>'.__('Message', SH_NAME).'</strong>', 'required|min_length[5]');
		if( sh_set($settings, 'contact_captcha_status'))
		{
			include_once( get_template_directory().'/includes/thirdparty/recaptchalib.php');
			$privatekey = sh_set($settings, 'recaptcha_private');
			
			$resp = recaptcha_check_answer ($privatekey,
                                 $_SERVER["REMOTE_ADDR"],
                                 $_POST["recaptcha_challenge_field"],
                                 $_POST["recaptcha_response_field"]);
			
			if( !$resp->is_valid )
			{
					$t->validation->_error_array['captcha'] = __('Invalid captcha entered, please try again.', SH_NAME);
			}
	
		}
		$messages = '';
		if($t->validation->run() !== FALSE && empty($t->validation->_error_array))
		{
			$name = $t->validation->post('contact_name');
			$email = $t->validation->post('contact_email');
			$company = $t->validation->post('contact_company');
			$subject = $t->validation->post('contact_subject');
			
			$message = __("Contact Name:\t", SH_NAME).$name."\r\n";
			$message .= __("Contact Company:\t", SH_NAME).$company."\r\n";
			$message .= __("Contact Subject:\t", SH_NAME).$subject."\r\n";
			
			$message .= "\r\n".$t->validation->post('contact_message'); 
	
			$contact_to = sanitize_email($receiver_email) ? $receiver_email : get_option('admin_email');
			
			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n";
			wp_mail($contact_to, sprintf(__('Contact Us Message from %s', SH_NAME), get_bloginfo('name') ), $message, $headers);
	
			echo "<fieldset>";
			echo "<div id='success_page' class='alert alert-success'>";
			echo "<h1>".__('Email Sent Successfully.', SH_NAME)."</h1>";
			echo "<p>".sprintf(__("Thank you <strong>%s</strong>, your message has been submitted to us.", SH_NAME), $name)."</p>";
			echo "</div>";
			echo "</fieldset>";
			exit;
		
		}else
		{
	
			 if( is_array( $t->validation->_error_array ) )
			 {
				 foreach( $t->validation->_error_array as $msg )
				 {
					 $messages .= '<div class="alert alert-danger">'.__('Error! ', SH_NAME).$msg.'</div>';
				 }
			}
	
		}
	
		echo $messages;exit;
	}
	
	//mail to friend
	function mail_to_friend()
	{
		if( !count( $_POST ) ) return;
	
		_load_plugins_class( 'validation', 'helpers', true );
		$t = $GLOBALS['_sh_base'];//printr($t);
		$settings = $t->option();
		
		//$post_test = sh_set( $_POST, 'test' );
		//$rec_email  = sanitize_email( $post_test ) ? sanitize_email( $post_test ) : _sh_generate_salt( $post_test, true );
		/** set validation rules for contact form */
		$t->validation->set_rules('friend_email','<strong>'.__('Email', SH_NAME).'</strong>', 'required|valid_email');
		$t->validation->set_rules('friend_message','<strong>'.__('Message', SH_NAME).'</strong>', 'required|min_length[5]');
		
		$messages = '';
		if($t->validation->run() !== FALSE && empty($t->validation->_error_array))
		{
			$email = $t->validation->post('friend_email');
			
			$message .= "\r\n".$t->validation->post('friend_message'); 
	
			$contact_to = sanitize_email($email);
			
			$headers = 'From: '.get_bloginfo('name').' <'.get_bloginfo('admin_email').'>' . "\r\n";
			wp_mail($contact_to, sprintf(__('Product referal Message from %s', SH_NAME), get_bloginfo('name') ), $message, $headers);
			
			
			
			
			echo json_encode( array('code'=>'success', 'msg' => esc_html__('You message successfully delivered', SH_NAME) ) );
			exit;
		
		}else
		{
	
			 if( is_array( $t->validation->_error_array ) )
			 {
				 foreach( $t->validation->_error_array as $msg )
				 {
					 $messages .= '<div class="alert alert-danger">'.__('Error! ', SH_NAME).$msg.'</div>';
				 }
			}
			echo json_encode( array('code'=>'fail', 'msg' => $messages ) );
		}
	
		echo $messages;exit;
	}
		
	function wishlist()
	{
		global $current_user;
      	get_currentuserinfo();
			
		if( is_user_logged_in() ){
			
			$meta = (array)get_user_meta( $current_user->ID, '_ja_product_wishlist', true );
			$data_id = sh_set( $_POST, 'data_id' );
			if( $meta && is_array( $meta ) ){
				if( in_array( $data_id, $meta ) ){
					exit(json_encode(array('code'=>'exists', 'msg'=>__('You have already added this product to wish list', SH_NAME ) ) ) );
				}
				$newmeta = array_merge( array( sh_set( $_POST, 'data_id' ) ), $meta );
				update_user_meta( $current_user->ID, '_ja_product_wishlist', array_unique($newmeta) );
				exit(json_encode(array('code'=>'success', 'msg'=>__('Product successfully added to wishlist', SH_NAME ) ) ) );
			}else{
				exit(json_encode(array('code'=>'fail', 'msg'=>__('There is an error edding wishlist', SH_NAME ) ) ) );
			}
		}
		else exit(json_encode(array('code'=>'fail', 'msg'=>__('Please login first to add the product to your wishlist', SH_NAME ) ) ) );
	}
	
	function wishlist_del()
	{
		global $current_user;
      	get_currentuserinfo();
			
		if( is_user_logged_in() ){
			
			$meta = get_user_meta( $current_user->ID, '_ja_product_wishlist', true );
			$data_id = sh_set( $_POST, 'data_id' );
			if( $meta && is_array( $meta ) ){
				$searched = array_search( $data_id, $meta );
				if( isset($meta[$searched]) ){
					unset( $meta[$searched] );
					update_user_meta( $current_user->ID, '_ja_product_wishlist', array_unique($meta) );
					exit(json_encode(array('code'=>'del', 'msg'=>__('Product is successfully deleted from wishlist', SH_NAME ) ) ) );
				}else exit(json_encode(array('code'=>'fail', 'msg'=>__('Unable to find this product into wishlist', SH_NAME ) ) ) );
			}else{
				update_user_meta( $current_user->ID, '_ja_product_wishlist', array( sh_set( $_POST, 'data_id' ) ) );
				exit(json_encode(array('code'=>'fail', 'msg'=>__('Unable to retrieve your wishlist', SH_NAME ) ) ) );
			}
		}
		else exit(json_encode(array('code'=>'fail', 'msg'=>__('Please login first to add/delete product in your wishlist', SH_NAME ) ) ) );
	}
	
	
	function compare()
	{
		global $current_user;
      	get_currentuserinfo();
			
		if( is_user_logged_in() ){
			
			$meta = (array)get_user_meta( $current_user->ID, '_ja_product_comparelist', true );
			$data_id = sh_set( $_POST, 'data_id' );
			if( $meta && is_array( $meta ) ){
				if( in_array( $data_id, $meta ) ){
					exit(json_encode(array('code'=>'exists', 'msg'=>__('You have already added this product to compare list', SH_NAME ) ) ) );
				}
				$newmeta = array_merge( array( sh_set( $_POST, 'data_id' ) ), $meta );
				update_user_meta( $current_user->ID, '_ja_product_comparelist', array_unique($newmeta) );
				exit(json_encode(array('code'=>'success', 'msg'=>__('Product successfully added to compare list', SH_NAME ) ) ) );
			}else{
				exit(json_encode(array('code'=>'fail', 'msg'=>__('There is an error edding compare list', SH_NAME ) ) ) );
			}
		}
		else exit(json_encode(array('code'=>'fail', 'msg'=>__('Please login first to add the product to your compare list', SH_NAME ) ) ) );
	}
	
	function compare_del()
	{
		global $current_user;
      	get_currentuserinfo();
			
		if( is_user_logged_in() ){
			
			$meta = get_user_meta( $current_user->ID, '_ja_product_comparelist', true );
			$data_id = sh_set( $_POST, 'data_id' );
			if( $meta && is_array( $meta ) ){
				$searched = array_search( $data_id, $meta );
				if( isset($meta[$searched]) ){
					unset( $meta[$searched] );
					update_user_meta( $current_user->ID, '_ja_product_comparelist', array_unique($meta) );
					exit(json_encode(array('code'=>'del', 'msg'=>__('Product is successfully deleted from compare list', SH_NAME ) ) ) );
				}else exit(json_encode(array('code'=>'fail', 'msg'=>__('Unable to find this product into compare list', SH_NAME ) ) ) );
			}else{
				update_user_meta( $current_user->ID, '_ja_product_comparelist', array( sh_set( $_POST, 'data_id' ) ) );
				exit(json_encode(array('code'=>'fail', 'msg'=>__('Unable to retrieve your compare list', SH_NAME ) ) ) );
			}
		}
		else exit(json_encode(array('code'=>'fail', 'msg'=>__('Please login first to add/delete product in your compare list', SH_NAME ) ) ) );
	}
	
	
	function download_rating()
	{
		$ip = $_SERVER['REMOTE ADDR'];
		extract( $_POST );
		
		$meta = get_post_meta( $post_id, '_download_rating', true );
		
		if( !sh_set( $meta, $ip ) )
		{
			$meta[$ip] = $value;
			
			update_post_meta( $post_id, '_download_rating', $meta );
			
			echo 'success';exit;
		}
		
		exit( 'failed' );
	}
	
	function location_results()
	{
		$value = sh_set( $_POST, 'value' );
		$query = new WP_Query(array('post_type' => 'sh_property', 
									'meta_query' => array(
										array(
											'key'     => '_sh_address',
											'value'   => $value,
											'compare' => 'LIKE',
										),
									),
							));
		printr($query);
	}
	
	function properties()
	{
		$paged = sh_set($_POST, 'page') + 1;
		$query_args = array('post_type' => 'sh_property' , 'showposts' => sh_set($_POST, 'num') , 'order_by' => sh_set($_POST, 'sort') , 'order' => sh_set($_POST, 'order'), 'paged' => $paged );

		if( sh_set($_POST, 'cat' ) ) $query_args['property_category'] = sh_set($_POST, 'cat' );

		$query = new WP_Query($query_args) ; 

		while($query->have_posts()): $query->the_post();

			global $post ;
			$property_meta = _WSH()->get_meta(); ?>

				<!--======= PROPERTY =========-->
				<li class="col-sm-4"> 
					<!--======= TAGS =========-->

					<section> 
						<!--======= IMAGE =========-->
						<div class="img"> 
							<?php the_post_thumbnail('370x230', array('class' => 'img-responsive'));?> 
							<!--======= IMAGE HOVER =========-->

							<div class="over-proper"> <a href="<?php the_permalink();?>" class="btn font-montserrat"><?php esc_html_e('more details', SH_NAME);?></a> </div>
						</div>
						<!--======= HOME INNER DETAILS =========-->
						<ul class="home-in">
							<li><span><i class="fa fa-home"></i> <?php echo sh_set($property_meta, 'area');?></span></li>
							<li><span><i class="fa fa-bed"></i> <?php echo sh_set($property_meta, 'bedrooms');?></span></li>
							<li><span><i class="fa fa-tty"></i> <?php echo sh_set($property_meta, 'bathrooms');?></span></li>
						</ul>
						<!--======= HOME DETAILS =========-->
						<div class="detail-sec"> <a href="<?php the_permalink();?>" class="font-montserrat"><?php the_title();?></a> <span class="locate"><i class="fa fa-map-marker"></i> <?php echo sh_set($property_meta, 'address');?></span> <span class="price-bg  font-montserrat"><?php echo sh_set($property_meta, 'price');?></span> <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('more details', SH_NAME);?></a> </div>
					</section>
				</li>

		<?php endwhile;
		wp_reset_postdata();
	}
}
