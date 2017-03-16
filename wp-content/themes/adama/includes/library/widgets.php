<?php
//--------------- sidebar widgets ---------------

class SH_Search extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Search', /* Name */esc_html__('Realtor Search',SH_NAME), array(      'description' => esc_html__('Realtor Search', SH_NAME )) );
	}
	
	/** @see WP_Widget::widget */
    
	 function widget($args, $instance)
	 {

	 	global $wpdb;

	    extract( $args );
		echo balanceTags($before_widget);
		$title = apply_filters( 'widget_title', $instance['title'] );?>

			
		<!--======= FIND PROPERTY =========-->
          <div class="finder"> 
            
            <!--======= FORM SECTION =========-->
            <div class="find-sec search_widget">
              <?php echo balanceTags($before_title.$title.$after_title);?>
              
			  <form method="get" action="<?php echo home_url(); ?>">
			  <ul class="row">
                
                <?php $cities = get_terms( 'property_city' ); //printr($cities); ?>
                <!--======= FORM =========-->
                <li class="col-sm-12">
                  <select name="search_city" class="selectpicker">
                    <option value=""><?php esc_html_e('City', SH_NAME);?></option>

                    <?php if( $cities) foreach( $cities as $cit): ?>
                    	<option value="<?php echo esc_attr( $cit->slug ); ?>"><?php echo esc_attr( $cit->name );?></option>
                	<?php endforeach; ?>
					
                  </select>
                </li>
                
                <!--======= FORM =========-->
                <li class="col-sm-12">
                  <input class="location" type="text" placeholder="<?php esc_html_e('Location', SH_NAME);?>" name="location" id="location" />
                </li>
                
                <!--======= FORM =========-->
                <?php $prop_status = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key = %s GROUP BY meta_value", '_sh_property_status')); //printr($prop_status); ?>
                <li class="col-sm-12">
                  <select name="property_status" class="selectpicker">
                    <option value=""><?php esc_html_e('Property Status', SH_NAME);?></option>
                    <?php if( $prop_status ) foreach($prop_status as $p_status): 
                    	if( !sh_set( $p_status, 'meta_value' ) ) continue; ?>
						<option value="<?php echo esc_attr(sh_set( $p_status, 'meta_value' )); ?>"><?php echo esc_attr(ucwords(sh_set( $p_status, 'meta_value' ))) ?></option>
                    <?php endforeach; ?>
                  </select>
                </li>
                
                <!--======= FORM =========-->

                <?php $prop_status = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key = %s GROUP BY meta_value", '_sh_property_type')); //printr($prop_status); ?>
                <li class="col-sm-12">
                  <select name="property_type" class="selectpicker">
                    <option value=""><?php esc_html_e('Property Type', SH_NAME);?></option>
                    <?php if( $prop_status ) foreach($prop_status as $p_status): 
                    	if( !sh_set( $p_status, 'meta_value' ) ) continue; ?>
						<option value="<?php echo esc_attr(sh_set( $p_status, 'meta_value' )); ?>"><?php echo esc_attr(ucwords(sh_set( $p_status, 'meta_value' ))) ?></option>
                    <?php endforeach; ?>
                  </select>
                </li>

                <!--======= FORM =========-->
                <li class="col-sm-12">
                  <select name="property_bedrooms" class="selectpicker">
                    <option value=""><?php esc_html_e('No of Bedrooms', SH_NAME);?></option>
                    <option><?php esc_html_e('1', SH_NAME);?></option>
					<option><?php esc_html_e('2', SH_NAME);?></option>
					<option><?php esc_html_e('3', SH_NAME);?></option>
					<option><?php esc_html_e('4', SH_NAME);?></option>
					<option><?php esc_html_e('5', SH_NAME);?></option>
                  </select>
                </li>
                
                <!--======= FORM =========-->
                <li class="col-sm-12">
                  <select name="property_bathrooms" class="selectpicker">
                    <option value=""><?php esc_html_e('No of Bathrooms', SH_NAME);?></option>
                    <option><?php esc_html_e('1', SH_NAME);?></option>
					<option><?php esc_html_e('2', SH_NAME);?></option>
					<option><?php esc_html_e('3', SH_NAME);?></option>
					<option><?php esc_html_e('4', SH_NAME);?></option>
					<option><?php esc_html_e('5', SH_NAME);?></option>
                  </select>
                </li>
                <li class="col-sm-12">
                  
				  <input class="location" type="text" placeholder="<?php esc_html_e('Minimum Price', SH_NAME);?>" name="min_price" id="min_price" />
				  
                </li>
                <li class="col-sm-12">
				
                  <input class="location" type="text" placeholder="<?php esc_html_e('Maximum Price', SH_NAME);?>" name="max_price" id="max_price" />
				  
				</li>
                <li class="col-sm-12"> 
                	<input type="hidden" name="post_type" value="sh_property">
                	<input type="hidden" name="s" value="">
                	<button type="submit" class="btn">SEARCH</button> 
                </li>
              </ul>
			  </form>
            </div>
		</div>
		
		<?php echo balanceTags($after_widget);
		
		 
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		//$instance['title'] = $new_instance['title'];
		$instance['title'] = $new_instance['title'];
		
		
		return $instance;
	}
	
	 function form($instance)
	{
		//$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('About us', SH_NAME);
		$title = ( $instance ) ? esc_attr($instance['title']) : 'Search for properties';
		?>
		
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php 
	}
}
class SH_Recent_Posts extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Recent_Posts', /* Name */esc_html__('Realtor Blog Recent Posts ',SH_NAME), array( 'description' => esc_html__('Realtor  New items with images', SH_NAME )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo balanceTags($before_widget);
		
		echo balanceTags($before_title.$title.$after_title); 
		
		$query_string = 'posts_per_page='.$instance['number'].'&post_type=post';
		if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
		$query = new WP_Query( $query_string ); 
	
		$this->posts($query);
		wp_reset_postdata(); 
		
		echo balanceTags($after_widget);
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
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Recent Posts', SH_NAME);
		$number = ( $instance ) ? esc_attr($instance['number']) : 4;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
        </p>
       
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', SH_NAME); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=> esc_html__('All Categories', SH_NAME), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
        
		<?php 
	}
	
	function posts($query)
	{
		if( $query->have_posts() ):?>
        <?php $count = 0; ?>
        
        <div class="row m0 latestPosts">
		
		  <?php while( $query->have_posts() ): $query->the_post(); ?>
			
			<div class="media latestPost">
				<div class="media-left">
					<a href="<?php the_permalink();?>">
						<?php the_post_thumbnail('65x65');?>
					</a>
				</div>
				<div class="media-body">
					<h5 class="heading"><?php the_title();?></h5>
					<p><?php echo get_the_date('M d, Y');?></p>
				</div>
			</div>
		
		<?php endwhile;?>
	
	</div>
            
		<?php endif;
    }
}
// featured properties widget
class SH_featured_properties extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_featured_properties', /* Name */__('Realtor Featured Properties',SH_NAME), array( 'description' => esc_html__('Realtor Featured Properties', SH_NAME )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo balanceTags($before_widget);
		
		echo balanceTags($before_title.$title.$after_title); 
		
		$query_string = 'posts_per_page='.$instance['number'].'&post_type=sh_property';
		if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
		$query = new WP_Query( $query_string ); 
	
		$this->posts($query);
		wp_reset_postdata(); 
		
		echo balanceTags($after_widget);
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
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Featured Properties', SH_NAME);
		$number = ( $instance ) ? esc_attr($instance['number']) : 4;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
    <?php esc_html_e('Title: ', SH_NAME); ?>
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
    <?php esc_html_e('No. of Posts:', SH_NAME); ?>
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>">
    <?php esc_html_e('Category', SH_NAME); ?>
  </label>
  <?php wp_dropdown_categories( array('show_option_all'=>__('All Categories', SH_NAME), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
</p>
<?php 
	}

function posts($query)
	{
		if( $query->have_posts() ):?>
<?php $count = 0; ?>
<div class="flicker-post margin-t-40">
            <hr>
            <ul>
              <?php while( $query->have_posts() ): $query->the_post(); ?>
              <li> 
              	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('class'=>'img-responsive'));?></a> 
              </li>
              <?php endwhile; ?>
            </ul>
          </div>
          <?php endif; 
    }
}
// categories 
 class SH_categories extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_categories', /* Name */__('Realtor Categories',SH_NAME), array( 'description' => esc_html__('Categories', SH_NAME )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo balanceTags($before_widget);
		
		echo balanceTags($before_title.$title.$after_title); 
		
		$query_string = 'posts_per_page='.$instance['number'].'&post_type=sh_property';
		if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
		$query = new WP_Query( $query_string ); 
	
		$this->posts($query);
		wp_reset_postdata(); 
		
		echo balanceTags($after_widget);
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
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Recent Properties', SH_NAME);
		$number = ( $instance ) ? esc_attr($instance['number']) : 4;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
    <?php esc_html_e('Title: ', SH_NAME); ?>
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
    <?php esc_html_e('No. of Posts:', SH_NAME); ?>
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>">
    <?php esc_html_e('Category', SH_NAME); ?>
  </label>
  <?php wp_dropdown_categories( array('show_option_all'=>__('All Categories', SH_NAME), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
</p>
<?php 
	}

function posts($query)
	{
		if( $query->have_posts() ):?>
<?php $count = 0; ?>
<!--======= Recent Properties =========-->
          <div class="recent-come margin-t-40">
            <hr>
            <ul class="recent-come">
            	<?php while($query->have_posts()): $query->the_post();
                 $property_meta = _WSH()->get_meta(); ?>
              <li>
                <div class="img-post"> <?php the_post_thumbnail('thumbnail',array('class'=>'img-responsive'));?> </div>
                <div class="text-post"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo sh_set($property_meta,'price');?></span>			                </div>
              </li>
              <?php endwhile; ?>
            </ul>
          </div>
                    <?php endif; 
    }
}

// Social Media
class SH_SocialMedia extends WP_Widget
{
	/** constructor */
	
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_SocialMedia', /* Name */esc_html__('Realtor Social Media',SH_NAME), array( 'description' => esc_html__('Realtor Social Media', SH_NAME )) );
	}
	
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		?>
		<?php echo $before_title.$title.$after_title;?>
        <div class="socil-action margin-t-40">
            <hr>
            <ul>
              <li> <a class="rss" href="<?php echo $instance['rss']; ?>"><i class="fa fa-rss"></i>RSS FEED</a> </li>
              <li> <a class="tw" href="<?php echo $instance['twitter']; ?>"><i class="fa fa-twitter"></i>follow us</a> </li>
              <li> <a class="fb" href="<?php echo $instance['facebook']; ?>"><i class="fa fa-facebook"></i>LIKE US</a> </li>
              <li> <a class="pin" href="<?php echo $instance['pinterest']; ?>"><i class="fa fa-pinterest"></i>follow us</a> </li>
              <li> <a class="drib" href="<?php echo $instance['dribbble']; ?>"><i class="fa fa-dribbble"></i>follow us</a> </li>
              <li> <a class="g-plus" href="<?php echo $instance['gplus']; ?>"><i class="fa fa-google-plus"></i>plus 1 us</a> </li>
            </ul>
          </div>
            <!-- end social -->
		<?php
         echo $after_widget;
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['gplus'] = $new_instance['gplus'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['dribbble'] = $new_instance['dribbble'];
		$instance['rss'] = $new_instance['rss'];
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{	
		$title		= ($instance) ? esc_attr($instance['title']) : 'Social Profile';
		$facebook		= ($instance) ? esc_attr($instance['facebook']) : 'https://www.facebook.com/';
		$twitter 		= ($instance) ? esc_attr($instance['twitter']) : 'https://www.twitter.com/';
		$gplus 			= ($instance) ? esc_attr($instance['gplus']) : 'https://www.googleplus.com/';
		$pinterest 		= ($instance) ? esc_attr($instance['pinterest']) : 'https://www.pinterest.com/';
		$dribbble		= ($instance) ? esc_attr($instance['dribbble']) : 'https://www.dribbble.com/';
		$rss 			= ($instance) ? esc_attr($instance['rss']) : 'https://www.rss.com/';
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>"><?php esc_html_e('Facebook:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name('facebook') ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
        </p>       
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>"><?php esc_html_e('Twitter:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter') ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('gplus') ); ?>"><?php esc_html_e('Google Plus:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('gplus') ); ?>" name="<?php echo esc_attr( $this->get_field_name('gplus') ); ?>" type="text" value="<?php echo esc_attr( $gplus ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>"><?php esc_html_e('Pinterest:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pinterest') ); ?>" type="text" value="<?php echo esc_attr( $pinterest ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('dribbble') ); ?>"><?php esc_html_e('Dribbble:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('dribbble') ); ?>" name="<?php echo esc_attr( $this->get_field_name('dribbble') ); ?>" type="text" value="<?php echo esc_attr( $dribbble ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('rss') ); ?>"><?php esc_html_e('RSS Feed:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('rss') ); ?>" name="<?php echo esc_attr( $this->get_field_name('rss') ); ?>" type="text" value="<?php echo esc_attr( $rss ); ?>" />
        </p>        
		<?php 
	}
}
// Subscribe to our mailing list
class SH_feedburner extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_subscribe_mail_list', /* Name */esc_html__('Realtor Subscribe to Mailing List',SH_NAME), array( 'description' => esc_html__('create account on http://feedburner.com and allow users to subscribe', SH_NAME )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $before_widget;?>
        
        <!--======= NEWSLETTER =========-->
		<div class="subcribe">
			<div class="col-sm-5 no-padding">
			  <?php echo $before_title . $title . $after_title ; ?>
			</div>
			
			<div class="col-sm-7 no-padding">
			  <form target="popupwindow" method="post" id="subscribe" action="http://feedburner.google.com/fb/a/mailverify" accept-charset="utf-8" class="newsletter_form">
				<input class="font-montserrat" type="email" placeholder="<?php esc_html_e('E-mail Address', SH_NAME);?>" name="email" value="" id="email" required>
				<input type="hidden" id="uri" name="uri" value="<?php echo $instance['ID']; ?>">
				<input type="hidden" value="en_US" name="loc">
				<button type="submit" class="btn"><?php esc_html_e(" Subscribe" , SH_NAME); ?></button>
			  </form>
			</div>
		
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
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Subscribe to Our Mailing List', SH_NAME);
		$ID = ($instance) ? esc_attr($instance['ID']) : 'themeforest';
		
		?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
       
        <p>
            <label for="<?php echo $this->get_field_id('ID'); ?>"><?php esc_html_e('Feedburner ID:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('ID'); ?>" name="<?php echo $this->get_field_name('ID'); ?>" type="text" value="<?php echo esc_attr($ID); ?>" />
        </p>
		<?php 
	}
}
// twitter
class SH_Twitter extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Twitter', /* Name */esc_html__('Realtor Tweets',SH_NAME), array( 'description' => esc_html__('Grab the latest tweets from twitter', SH_NAME )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo balanceTags($before_widget);?>
        
		<?php $number = (sh_set($instance, 'number') ) ? esc_attr(sh_set($instance, 'number')) : 2; ?>

		<script type="text/javascript"> jQuery(document).ready(function($) {$('#twitter_update').tweets({screen_name: '<?php echo esc_js($instance['twitter_id']); ?>', number: <?php echo esc_js($number); ?>});});</script>
		<!--======= LINKS =========-->
          <?php echo balanceTags($before_title.$title.$after_title); ?>
          <hr>
          <ul id="twitter_update" class="tweet"></ul>
        
		<?php
		
		echo balanceTags($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['number'] = $new_instance['number'];

		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Recent Tweets', SH_NAME);
		$twitter_id = ($instance) ? esc_attr($instance['twitter_id']) : 'wordpress';
		$number = ( $instance ) ? esc_attr($instance['number']) : '';?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>"><?php esc_html_e('Twitter ID:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter_id')); ?>" type="text" value="<?php echo esc_attr($twitter_id); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of Tweets:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
        </p>
        
                
		<?php 
	}
}
// Contact us
class SH_Contactinfo extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Contactinfo', /* Name */esc_html__('Realtor contact info',SH_NAME), array( 'description' => esc_html__('Contact info', SH_NAME )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $before_widget;?>
        
        <!--======= LINKS =========-->
		  <?php echo $before_title . $title . $after_title ; ?>
		  <hr>
		  <div class="loc-info">
			<p><i class="fa fa-map-marker"></i><?php echo $instance['address']; ?></p>
			<p><i class="fa fa-phone"></i> <?php echo $instance['phone']; ?></p>
			<p><i class="fa fa-print"></i> <?php echo $instance['fax']; ?></p>
			<p><i class="fa fa-envelope-o"></i> <?php echo $instance['email']; ?></p>
		  </div>
		
		<?php
		
		echo $after_widget;
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['fax'] = $new_instance['fax'];
		$instance['email'] = $new_instance['email'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Contact', SH_NAME);
		$address = ($instance) ? esc_attr($instance['address']) : '';
		$phone = ($instance) ? esc_attr($instance['phone']) : '';
		$fax = ($instance) ? esc_attr($instance['fax']) : '';
		$email = ($instance) ? esc_attr($instance['email']) : '';
		
		?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
       
        <p>
            <label for="<?php echo $this->get_field_id('address'); ?>"><?php esc_html_e('Address:', SH_NAME); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text"><?php echo esc_attr($address); ?></textarea>
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('phone'); ?>"><?php esc_html_e('Phone:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('fax'); ?>"><?php esc_html_e('Fax:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo esc_attr($fax); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('email'); ?>"><?php esc_html_e('Email:', SH_NAME); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
        </p>
		<?php 
	}
}