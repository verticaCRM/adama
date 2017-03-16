<?php //exit("sssss");  
global $wpdb;
wp_enqueue_script(array('jquery-nouislider-min'));
   ob_start() ;?>

<!--======= FIND PROPERTY =========-->
<div class="finder">
  <div class="container">
	<h1><?php echo balanceTags($title);?></h1>
	
	<!--======= FORM SECTION =========-->
	<div class="find-sec">
	  <form method="get" action="<?php echo home_url(); ?>">

		  <ul class="row">
			
			<!--======= FORM =========-->
			<li class="col-sm-3">
			  
			  <?php $cities = get_terms( 'property_city' ); //printr($cities); ?>

			  <label><?php esc_html_e('Choose The City', SH_NAME);?></label>
			  <select name="search_city" class="selectpicker">
				<option value=""><?php esc_html_e('Choose', SH_NAME);?></option>
				<?php if( $cities) foreach( $cities as $cit): ?>
                	<option value="<?php echo esc_attr( $cit->slug ); ?>"><?php echo esc_attr( $cit->name );?></option>
            	<?php endforeach; ?>
			  </select>
			</li>
			
			<!--======= FORM =========-->
			<li class="col-sm-3">
			  <label><?php esc_html_e('Location', SH_NAME);?></label>
			  <input class="location" autocomplete="off" type="text" placeholder="<?php esc_html_e('Location', SH_NAME);?>" name="location" id="location" />
			  <div class="location-result"></div>
			</li>
			
			<!--======= FORM =========-->
			<li class="col-sm-3">

				<?php $prop_status = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key = %s GROUP BY meta_value", '_sh_property_status')); //printr($prop_status); ?>

				<label><?php esc_html_e('Property Status', SH_NAME);?></label>
				<select name="property_status" class="selectpicker">
					<option value=""><?php esc_html_e('Choose', SH_NAME);?></option>
					<?php if( $prop_status ) foreach($prop_status as $p_status): 
						if( !sh_set( $p_status, 'meta_value' ) ) continue; ?>
						<option value="<?php echo esc_attr(sh_set( $p_status, 'meta_value' )); ?>"><?php echo esc_attr(ucwords(sh_set( $p_status, 'meta_value' ))) ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			
			<!--======= FORM =========-->
			<li class="col-sm-3">
				<?php $prop_status = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key = %s GROUP BY meta_value", '_sh_property_type')); //printr($prop_status); ?>
				
				<label><?php esc_html_e('Property Type', SH_NAME);?></label>
				
				<select name="property_type" class="selectpicker">
					<option value=""><?php esc_html_e('Choose', SH_NAME);?></option>
					<?php if( $prop_status ) foreach($prop_status as $p_status): 
                    	if( !sh_set( $p_status, 'meta_value' ) ) continue; ?>
						<option value="<?php echo esc_attr(sh_set( $p_status, 'meta_value' )); ?>"><?php echo esc_attr(ucwords(sh_set( $p_status, 'meta_value' ))) ?></option>
                    <?php endforeach; ?>
				</select>
			</li>
			
			<!--======= FORM =========-->
			<li class="col-sm-3">
			  <label><?php esc_html_e('No of Bedrooms', SH_NAME);?></label>
			  <select name="property_bedrooms" class="selectpicker">
              	<option value=""><?php esc_html_e('Choose', SH_NAME);?></option>
				<option value="1"><?php esc_html_e('1', SH_NAME);?></option>
				<option value="2"><?php esc_html_e('2', SH_NAME);?></option>
				<option value="3"><?php esc_html_e('3', SH_NAME);?></option>
				<option value="4"><?php esc_html_e('4', SH_NAME);?></option>
				<option value="5"><?php esc_html_e('5', SH_NAME);?></option>
				<option value="6"><?php esc_html_e('6', SH_NAME);?></option>
				<option value="7"><?php esc_html_e('7', SH_NAME);?></option>
				<option value="8"><?php esc_html_e('8', SH_NAME);?></option>
				<option value="9"><?php esc_html_e('9', SH_NAME);?></option>
				<option value="10"><?php esc_html_e('10', SH_NAME);?></option>
			  </select>
			</li>
			
			<!--======= FORM =========-->
			<li class="col-sm-3">
			  <label><?php esc_html_e('No of Bathrooms', SH_NAME);?></label>
			  <select name="property_bathrooms" class="selectpicker">
              	<option value=""><?php esc_html_e('Choose', SH_NAME);?></option>
				<option value="1"><?php esc_html_e('1', SH_NAME);?></option>
				<option value="2"><?php esc_html_e('2', SH_NAME);?></option>
				<option value="3"><?php esc_html_e('3', SH_NAME);?></option>
				<option value="4"><?php esc_html_e('4', SH_NAME);?></option>
				<option value="5"><?php esc_html_e('5', SH_NAME);?></option>
				<option value="6"><?php esc_html_e('6', SH_NAME);?></option>
				<option value="7"><?php esc_html_e('7', SH_NAME);?></option>
				<option value="8"><?php esc_html_e('8', SH_NAME);?></option>
				<option value="9"><?php esc_html_e('9', SH_NAME);?></option>
				<option value="10"><?php esc_html_e('10', SH_NAME);?></option>
			  </select>
			</li>
			
			<!--======= Pricing Range =========-->
			<li class="col-sm-6">
			  <div class="row">
				<div class="col-sm-9">
				  <div class="cost-price-content">
					<label><?php esc_html_e('Pricing Range: ', SH_NAME);?><span id="price-min" class="price-min"></span> <i>-</i> 
					<span id="price-max" class="price-max"></span></label>
					<div id="price-range" class="price-range" data-min="<?php echo esc_attr($min);?>" data-max="<?php echo esc_attr($max);?>"></div>
				  </div>
				  <input type="hidden" name="min_price" value="<?php echo esc_attr($min);?>" />
				  <input type="hidden" name="max_price" value="<?php echo esc_attr($max);?>" />
				</div>
				
				<!--======= BUTTON =========-->
				<div class="col-sm-3 search">
					<input type="hidden" name="s" />
					<input type="hidden" name="post_type" value="sh_property" />
					<button type="submit" class="btn"><?php esc_html_e('Search', SH_NAME);?></button>
				</div>
			  </div>
			</li>
		  </ul>
	  </form>
	</div>
  </div>
</div>  

<?php 
$output = ob_get_contents(); 
ob_end_clean(); 
return $output ; ?>