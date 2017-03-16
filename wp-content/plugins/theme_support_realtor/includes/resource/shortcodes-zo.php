<?php
$sh_sc = array();
$sh_sc['sh_call_out'] = array(
			"name" => __("Call Out", SH_NAME),
			"base" => "sh_call_out",
			"class" => "",
			"category" => __('Preshop', SH_NAME),
			"icon" => 'fa-user' ,
			'description' => __('show the call out banner.', SH_NAME),
			"params" => array(
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Image Link", SH_NAME),
				   "param_name" => "link",
				   'value' => '',
				   "description" => __("Enter the Image Link", SH_NAME)
				),
				array(
				   "type" => "attach_image",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Image", SH_NAME),
				   "param_name" => "img",
				   'value' => '',
				   "description" => __("Enter the Image url", SH_NAME)
				),
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Image Title", SH_NAME),
				   "param_name" => "title",
				   'value' => '',
				   "description" => __("Enter the Image Title", SH_NAME)
				),
				array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __(" Background Color Check", SH_NAME),
						   "param_name" => "color_check",
						   'value' => array_flip(array('clearfix'=>__('None', SH_NAME),'banner clearfix'=>__('Black', SH_NAME),         'banner colorful clearfix'=>__('Orange', SH_NAME) ) ),			
						   "description" => __("Select the background image color.", SH_NAME)
						),
				
				
				
			)
	    );
		
		
		
		$sh_sc['sh_pricing-tables'] = array(
			"name" => __("Pricing tables", SH_NAME),
			"base" => "sh_pricing-tables",
			"class" => "",
			"category" => __('Preshop', SH_NAME),
			"icon" => 'fa-user' ,
			'description' => __('show the pricing list.', SH_NAME),
			"params" => array(
			
		
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Price Heading", SH_NAME),
				   "param_name" => "price_heading",
				   'value' => '',
				   "description" => __("Enter the price heading", SH_NAME)
				),
			    array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Price", SH_NAME),
				   "param_name" => "price",
				   'value' => '',
				   "description" => __("Enter the price", SH_NAME)
				),
			      	array(
						   "type" => "exploded_textarea",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Features", SH_NAME),
						   "param_name" => "features",
						   "description" => __("Enter One Feature per Line", SH_NAME)
						),
				
				  array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Enter the button name", SH_NAME),
				   "param_name" => "button_name",
				   'value' => '',
				   "description" => __("Enter the button name", SH_NAME)
				),
					array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Button link", SH_NAME),
				   "param_name" => "link",
				   'value' => '',
				   "description" => __("Enter the button link", SH_NAME)
				),
				
				
			)
	    );
					
		$sh_sc['sh_parchase-lists'] = array(
			"name" => __("Parchase Lists", SH_NAME),
			"base" => "sh_parchase-lists",
			"class" => "",
			"category" => __('Preshop', SH_NAME),
			"icon" => 'fa-user' ,
			'description' => __('show the parchase list.', SH_NAME),
			"params" => array(
			
		
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Price Heading", SH_NAME),
				   "param_name" => "price_heading",
				   'value' => '',
				   "description" => __("Enter the price heading", SH_NAME)
				),
			    array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Price", SH_NAME),
				   "param_name" => "price",
				   'value' => '',
				   "description" => __("Enter the price", SH_NAME)
				),
			      	array(
						   "type" => "exploded_textarea",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Features", SH_NAME),
						   "param_name" => "features",
						   "description" => __("Enter One Feature per Line", SH_NAME)
						),
				
				  array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Enter the button name", SH_NAME),
				   "param_name" => "button_name",
				   'value' => '',
				   "description" => __("Enter the button name", SH_NAME)
				),
				
					array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Button link", SH_NAME),
				   "param_name" => "link",
				   'value' => '',
				   "description" => __("Enter the button link", SH_NAME)
				),
				
				
			)
	    );
					
			$sh_sc['sh_parallex'] = array(
			"name" => __("parallex", SH_NAME),
			"base" => "sh_parallex",
			"class" => "",
			"category" => __('Preshop', SH_NAME),
			'description' => __('show the Parallex banner.', SH_NAME),
			"params" => array(
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Msg Title",SH_NAME),
				   "param_name" => "msg_title",
				   'value' =>  '',
				   "description" => __("Enter the message title", SH_NAME)
				),
				array(
				   "type" => "attach_image",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("background image", SH_NAME),
				   "param_name" => "image",
				   "description" => __("Enter the  background image", SH_NAME)
				),
							array(
				   "type" => "textarea",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Short html Text", SH_NAME),
				   "param_name" => "content",
						 'value' =>'',
				   "description" => __("Enter content, you can use html tags", SH_NAME)
				),
				
				
				
			)
	    );
					
					
				$sh_sc['sh_parallex2'] = array(
			"name" => __("parallex2", SH_NAME),
			"base" => "sh_parallex2",
			"class" => "",
			"category" => __('Preshop', SH_NAME),
			'description' => __('show the Parallex 2 banner.', SH_NAME),
			"params" => array(
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Msg Title",SH_NAME),
				   "param_name" => "msg_title",
				   'value' => '',
				   "description" => __("Enter the message title", SH_NAME)
				),
						array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Button Link Title Attribute",SH_NAME),
				   "param_name" => "link_title",
				   'value' => '',
				   "description" => __("Enter the message title", SH_NAME)
				),
						array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Title",SH_NAME),
				   "param_name" => "msg_title",
				   'value' => '',
				   "description" => __("Enter the message title", SH_NAME)
				),
						array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Button Link URl",SH_NAME),
				   "param_name" => "link",
				   'value' =>  '',
				   "description" => __("Enter the button link url", SH_NAME)
				),
				array(
				   "type" => "attach_image",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("background image", SH_NAME),
				   "param_name" => "image",
				   "description" => __("Enter the  background image", SH_NAME)
				),
							array(
				   "type" => "textarea",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Short html Text", SH_NAME),
				   "param_name" => "content",
						 'value' =>  '',
				   "description" => __("Enter content, you can use html tags", SH_NAME)
				),
				
				
				
			)
	    );
	$sh_sc['sh_right_small_banner'] = array(
			"name" => __("Right Small Banner", SH_NAME),
			"base" => "sh_right_small_banner",
			"class" => "",
			"category" => __('Preshop', SH_NAME),
			"icon" => 'fa-user' ,
			'description' => __('show the mini banner.', SH_NAME),
			"params" => array(
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Image Link", SH_NAME),
				   "param_name" => "link",
				   'value' => '',
				   "description" => __("Enter the Image Link", SH_NAME)
				),
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Image Title", SH_NAME),
				   "param_name" => "title",
				   'value' => '',
				   "description" => __("Enter the Image Title", SH_NAME)
				),
				array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Banner Button 1 Status", SH_NAME),
						   "param_name" => "btn_status",
						   'value' => array_flip(array('active'=>__('active', SH_NAME),'none'=>__('none', SH_NAME) ) ),			
						   "description" => __("show button status.", SH_NAME)
						),
							array(
				   "type" => "attach_image",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Image", SH_NAME),
				   "param_name" => "img",
				   'value' => '',
				   "description" => __("Enter the Image url", SH_NAME)
				),
						array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Banner Button Link", SH_NAME),
				   "param_name" => "banner2_btn_link",
				   'value' => '',
				   "description" => __("Enter the banner2 button link", SH_NAME)
				),
						array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Banner  Button Text", SH_NAME),
				   "param_name" => "banner2_btn_text",
				   'value' => '',
				   "description" => __("Banner 2 Button Text", SH_NAME)
				),
						array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Banner  title", SH_NAME),
				   "param_name" => "banner2_title",
				   'value' => '',
				   "description" => __("Enter the banner2 title", SH_NAME)
				),
						
			)
	    );
			
					
			$sh_sc['sh_mini_banner'] = array(
			"name" => __("Mini Banner", SH_NAME),
			"base" => "sh_mini_banner",
			"class" => "",
			"category" => __('Preshop', SH_NAME),
			"icon" => 'fa-user' ,
			'description' => __('show the mini banner.', SH_NAME),
			"params" => array(
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Image Link", SH_NAME),
				   "param_name" => "link",
				   'value' => '',
				   "description" => __("Enter the Image Link", SH_NAME)
				),
						
							array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Banner Button 1  Link", SH_NAME),
				   "param_name" => "btn_link",
				   'value' => '',
				   "description" => __("Enter the button Link", SH_NAME)
				),
							array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Banner Button 1 Text", SH_NAME),
				   "param_name" => "btn_text",
				   'value' => '',
				   "description" => __("Enter the button title", SH_NAME)
				),
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Image Title", SH_NAME),
				   "param_name" => "title",
				   'value' => '',
				   "description" => __("Enter the Image Title", SH_NAME)
				),
				array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Banner Button 1 Status", SH_NAME),
						   "param_name" => "btn_status",
						   'value' => array_flip(array('active'=>__('active', SH_NAME),'none'=>__('none', SH_NAME) ) ),			
						   "description" => __("show button status.", SH_NAME)
						),
							array(
				   "type" => "attach_image",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Image", SH_NAME),
				   "param_name" => "img",
				   'value' => '',
				   "description" => __("Enter the Image url", SH_NAME)
				),
					
			
			)
	    );
					
					
			$sh_sc['sh_parallex'] = array(
			"name" => __("parallex", SH_NAME),
			"base" => "sh_parallex",
			"class" => "",
			"category" => __('Preshop', SH_NAME),
			'description' => __('show the Parallex banner.', SH_NAME),
			"params" => array(
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Msg Title",SH_NAME),
				   "param_name" => "msg_title",
				   'value' =>  __("Pretty & PreShop",SH_NAME),
				   "description" => __("Enter the message title", SH_NAME)
				),
				array(
				   "type" => "attach_image",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("background image", SH_NAME),
				   "param_name" => "image",
				   "description" => __("Enter the  background image", SH_NAME)
				),
							array(
				   "type" => "textarea",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Short html Text", SH_NAME),
				   "param_name" => "content",
						 'value' =>  __("Find your favorite design and put your personal touch on it before you buy..",SH_NAME),
				   "description" => __("Enter content, you can use html tags", SH_NAME)
				),
				
				
				
			)
	    );
$sh_sc['sh_services']	=	array(
					"name" => __("Services", SH_NAME),
					"base" => "sh_services",
					"class" => "",
					"category" => __('Preshop', SH_NAME),
					"icon" => 'fa-briefcase' ,
					'description' => __('Show Service Style 1 in 3 Columns.', SH_NAME),
					"params" => array(
					   	array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __( 'Do you want to show title on top', SH_NAME ),
						   "param_name" => "title_show",
						   'value' => array_flip(array('true'=>__('Show', SH_NAME),'false'=>__('None', SH_NAME)) ),			
						   "description" => __( 'select title if you want to show of top.', SH_NAME )
						),
					      array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __( 'Show read more button', SH_NAME ),
						   "param_name" => "button_read_more",
						   'value' => array_flip(array('true'=>__('Show', SH_NAME),'false'=>__('None', SH_NAME)) ),			
						   "description" => __( 'choose if you want to show read more button.', SH_NAME )
						),
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Title', SH_NAME ),
						   "param_name" => "title",
						   "description" => __('Enter the title.', SH_NAME )
						),
						  array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Inner Title', SH_NAME ),
						   "param_name" => "title_inner",
						   "description" => __('Enter the Inner title.', SH_NAME )
						),
							
					
					 
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Number', SH_NAME ),
						   "param_name" => "num",
						   "description" => __('Enter Number of Services to Show.', SH_NAME )
						),
		
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __( 'Category', SH_NAME ),
						   "param_name" => "cat",
						   "value" => array_flip( (array)sh_get_categories( array( 'taxonomy' => 'services_category', 'hide_empty' => FALSE ), true ) ),
						   "description" => __( 'Choose Category.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order By", SH_NAME),
						   "param_name" => "sort",
						   'value' => array_flip( array('date'=>__('Date', SH_NAME),'title'=>__('Title', SH_NAME) ,'name'=>__('Name', SH_NAME) ,'author'=>__('Author', SH_NAME),'comment_count' =>__('Comment Count', SH_NAME),'random' =>__('Random', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
						array(
						   "type" => "dropdown",
						   
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order", SH_NAME),
						   "param_name" => "order",
						   'value' => array_flip(array('ASC'=>__('Ascending', SH_NAME),'DESC'=>__('Descending', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
			
			
		
					)
				);
	$sh_sc['sh_team']	=	array(
					"name" => __("Teams", SH_NAME),
					"base" => "sh_team",
					"class" => "",
					"category" => __('Preshop', SH_NAME),
					"icon" => 'fa-briefcase' ,
					'description' => __('Show Team.', SH_NAME),
					"params" => array(
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Title', SH_NAME ),
						   "param_name" => "title",
						   "description" => __('Enter title.', SH_NAME )
						),
		              	array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Title Inner', SH_NAME ),
						   "param_name" => "title_inner",
						   "description" => __('Enter Inner Title .', SH_NAME )
						),
		
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Number', SH_NAME ),
						   "param_name" => "num",
						   "description" => __('Enter of Teams to show.', SH_NAME )
						),
		
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __( 'Category', SH_NAME ),
						   "param_name" => "cat",
						   "value" => array_flip( (array)sh_get_categories( array( 'taxonomy' => 'team_category', 'hide_empty' => FALSE ), true ) ),
						   "description" => __( 'Choose Category.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order By", SH_NAME),
						   "param_name" => "sort",
						   'value' => array_flip( array('date'=>__('Date', SH_NAME),'title'=>__('Title', SH_NAME) ,'name'=>__('Name', SH_NAME) ,'author'=>__('Author', SH_NAME),'comment_count' =>__('Comment Count', SH_NAME),'random' =>__('Random', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order", SH_NAME),
						   "param_name" => "order",
						   'value' => array_flip(array('ASC'=>__('Ascending', SH_NAME),'DESC'=>__('Descending', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
			
			
		
					)
				);
				
				$sh_sc['sh_testimonials']	=	array(
					"name" => __("Testimonials ( 2 Columns)", SH_NAME),
					"base" => "sh_testimonials",
					"class" => "",
					"category" => __('Preshop', SH_NAME),
					"icon" => 'fa-briefcase' ,
					'description' => __('Show testimonials Style 1 in 2 Columns.', SH_NAME),
					"params" => array(
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Number', SH_NAME ),
						   "param_name" => "num",
						   "description" => __('Enter Number of Services to Show.', SH_NAME )
						),
		                 array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Title', SH_NAME ),
						   "param_name" => "title",
						   "description" => __('Enter Title.', SH_NAME )
						),
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Tagline', SH_NAME ),
						   "param_name" => "tag",
						   "description" => __('Enter the tagline.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __( 'Category', SH_NAME ),
						   "param_name" => "cat",
						   "value" => array_flip( (array)sh_get_categories( array( 'taxonomy' => 'testimonial_category', 'hide_empty' => FALSE ), true ) ),
						   "description" => __( 'Choose Category.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order By", SH_NAME),
						   "param_name" => "sort",
						   'value' => array_flip( array('date'=>__('Date', SH_NAME),'title'=>__('Title', SH_NAME) ,'name'=>__('Name', SH_NAME) ,'author'=>__('Author', SH_NAME),'comment_count' =>__('Comment Count', SH_NAME),'random' =>__('Random', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order", SH_NAME),
						   "param_name" => "order",
						   'value' => array_flip(array('ASC'=>__('Ascending', SH_NAME),'DESC'=>__('Descending', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
			
			
		
					)
				);
				
				
				
				
				$sh_sc['sh_products']	=	array(
					"name" => __("Products ( 2 Columns)", SH_NAME),
					"base" => "sh_products",
					"class" => "",
					"category" => __('Preshop', SH_NAME),
					"icon" => 'fa-briefcase' ,
					'description' => __('Show Featured Products .', SH_NAME),
					"params" => array(
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Featured Posts Title', SH_NAME ),
						   "param_name" => "feature_title",
						   "description" => __('Enter Feature Post title.', SH_NAME )
						),
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Number', SH_NAME ),
						   "param_name" => "num",
						   "description" => __('Enter Number of Services to Show.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __( 'Category', SH_NAME ),
						   "param_name" => "cat",
						   "value" => array_flip( (array)sh_get_categories( array( 'taxonomy' => 'product_cat',                           'hide_empty' => FALSE ), true ) ),
						   "description" => __( 'Choose Category.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order By", SH_NAME),
						   "param_name" => "sort",
						   'value' => array_flip( array('date'=>__('Date', SH_NAME),'title'=>__('Title', SH_NAME) ,'name'=>__('Name', SH_NAME) ,'author'=>__('Author', SH_NAME),'comment_count' =>__('Comment Count', SH_NAME),'random' =>__('Random', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order", SH_NAME),
						   "param_name" => "order",
						   'value' => array_flip(array('ASC'=>__('Ascending', SH_NAME),'DESC'=>__('Descending', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
			
			
		
					)
				);
				
				
				$sh_sc['sh_best-sellers']	=	array(
					"name" => __(" Best Sellers", SH_NAME),
					"base" => "sh_best-sellers",
					"class" => "",
					"category" => __('Preshop', SH_NAME),
					"icon" => 'fa-briefcase' ,
					'description' => __('Show best selling products .', SH_NAME),
					"params" => array(
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Title', SH_NAME ),
						   "param_name" => "title",
						   "description" => __('Enter the title on the top', SH_NAME )
						),
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Set Old Price of items', SH_NAME ),
						   "param_name" => "old_price",
						   "description" => __('Enter the old price', SH_NAME )
						),
							array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Set the new price of the items', SH_NAME ),
						   "param_name" => "new_price",
						   "description" => __('Enter the new price', SH_NAME )
						),
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Number', SH_NAME ),
						   "param_name" => "num",
						   "description" => __('Enter Number of Services to Show.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __( 'Category', SH_NAME ),
						   "param_name" => "cat",
						   "value" => array_flip( (array)sh_get_categories( array( 'taxonomy' => 'product_cat',                           'hide_empty' => FALSE ), true ) ),
						   "description" => __( 'Choose Category.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order By", SH_NAME),
						   "param_name" => "sort",
						   'value' => array_flip( array('date'=>__('Date', SH_NAME),'title'=>__('Title', SH_NAME) ,'name'=>__('Name', SH_NAME) ,'author'=>__('Author', SH_NAME),'comment_count' =>__('Comment Count', SH_NAME),'random' =>__('Random', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order", SH_NAME),
						   "param_name" => "order",
						   'value' => array_flip(array('ASC'=>__('Ascending', SH_NAME),'DESC'=>__('Descending', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
			
			
		
					)
				);
				$sh_sc['sh_middle-slider']	=	array(
					"name" => __("Middle slider  Products ", SH_NAME),
					"base" => "sh_middle-slider",
					"class" => "",
					"category" => __('Preshop', SH_NAME),
					"icon" => 'fa-briefcase' ,
					'description' => __('Show Featured Products .', SH_NAME),
					"params" => array(
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Title', SH_NAME ),
						   "param_name" => "feature_title",
						   "description" => __('Enter Slider title.', SH_NAME )
						),
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Number', SH_NAME ),
						   "param_name" => "num",
						   "description" => __('Enter Number of Products to Show.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __( 'Category', SH_NAME ),
						   "param_name" => "cat",
						   "value" => array_flip( (array)sh_get_categories( array( 'taxonomy' => 'product_cat',                           'hide_empty' => FALSE ), true ) ),
						   "description" => __( 'Choose Category.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order By", SH_NAME),
						   "param_name" => "sort",
						   'value' => array_flip( array('date'=>__('Date', SH_NAME),'title'=>__('Title', SH_NAME) ,'name'=>__('Name', SH_NAME) ,'author'=>__('Author', SH_NAME),'comment_count' =>__('Comment Count', SH_NAME),'random' =>__('Random', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order", SH_NAME),
						   "param_name" => "order",
						   'value' => array_flip(array('ASC'=>__('Ascending', SH_NAME),'DESC'=>__('Descending', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
			
			           	array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Product's Old Price", SH_NAME ),
						   "param_name" => "old_price",
						   "description" => __("Enter Product's Old Price.", SH_NAME )
						),
		                	array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Product's New Price", SH_NAME ),
						   "param_name" => "new_price",
						   "description" => __("Enter Product's New Price.", SH_NAME )
						),
					)
				);
								
				
					$sh_sc['sh_from-blog']	=	array(
					"name" => __("From Blog", SH_NAME),
					"base" => "sh_from-blog",
					"class" => "",
					"category" => __('Preshop', SH_NAME),
					"icon" => 'fa-briefcase' ,
					'description' => __('Show Posts from the blog.', SH_NAME),
					"params" => array(
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Enter title', SH_NAME ),
						   "param_name" => "title",
						   "description" => __('Enter blog title.', SH_NAME )
						),
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Number', SH_NAME ),
						   "param_name" => "num",
						   "description" => __('Enter Number of Blog Posts to show.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __( 'Category', SH_NAME ),
						   "param_name" => "cat",
						   "value" => array_flip( (array)sh_get_categories( array( 'taxonomy' => 'category', 'hide_empty' =>          FALSE ), true ) ),
						   "description" => __( 'Choose Category.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order By", SH_NAME),
						   "param_name" => "sort",
						   'value' => array_flip( array('date'=>__('Date', SH_NAME),'title'=>__('Title', SH_NAME) ,'name'=>__('Name', SH_NAME) ,'author'=>__('Author', SH_NAME),'comment_count' =>__('Comment Count', SH_NAME),'random' =>__('Random', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order", SH_NAME),
						   "param_name" => "order",
						   'value' => array_flip(array('ASC'=>__('Ascending', SH_NAME),'DESC'=>__('Descending', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
			
			
		
					)
				);

					$sh_sc['sh_top-blog-posts']	=	array(
					"name" => __("top-blog-posts", SH_NAME),
					"base" => "sh_top-blog-posts",
					"class" => "",
					"category" => __('Preshop', SH_NAME),
					"icon" => 'fa-briefcase' ,
					'description' => __('Show Posts from the blog.', SH_NAME),
					"params" => array(
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __('Number', SH_NAME ),
						   "param_name" => "num",
						   "description" => __('Enter Number of Blog Posts to show.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __( 'Category', SH_NAME ),
						   "param_name" => "cat",
						   "value" => array_flip( (array)sh_get_categories( array( 'taxonomy' => 'category', 'hide_empty'                           => FALSE ), true ) ),
						   "description" => __( 'Choose Category.', SH_NAME )
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order By", SH_NAME),
						   "param_name" => "sort",
						   'value' => array_flip( array('date'=>__('Date', SH_NAME),'title'=>__('Title', SH_NAME) ,'name'=>__('Name', SH_NAME) ,'author'=>__('Author', SH_NAME),'comment_count' =>__('Comment Count', SH_NAME),'random' =>__('Random', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
						array(
						   "type" => "dropdown",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Order", SH_NAME),
						   "param_name" => "order",
						   'value' => array_flip(array('ASC'=>__('Ascending', SH_NAME),'DESC'=>__('Descending', SH_NAME) ) ),			
						   "description" => __("Enter the sorting order.", SH_NAME)
						),
			
			
		
					)
				);
				
		$sh_sc['sh_fun_facts']	=	array(
					"name" => __("Fun Facts", SH_NAME),
					"base" => "sh_fun_facts",
					"class" => "",
					"category" => __('Preshop', SH_NAME),
					"icon" => 'icon-wpb-layer-shape-text' ,
					"as_parent" => array('only' => 'sh_fact'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
					"content_element" => true,
					"show_settings_on_create" => false,
					'description' => __('Add Fun Facts to your theme.', SH_NAME),
					"params" => array(
						array(
						   "type" => "attach_image",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Background Image", SH_NAME),
						   "param_name" => "bg",
						   "description" => __("Upload Background Image", SH_NAME)
						),
					
					),
					"js_view" => 'VcColumnView'
				);
$sh_sc['sh_fact']	=	array(
					"name" => __("Fact", SH_NAME),
					"base" => "sh_fact",
					"class" => "",
					"category" => __('Preshop', SH_NAME),
					"icon" => 'icon-wpb-layer-shape-text' ,
					"as_child" => array('only' => 'sh_fun_facts'),// Use only|except attributes to limit child shortcodes (separate multiple values with comma)
					"content_element" => true,
					"show_settings_on_create" => true,
					'description' => __('Add Fact.', SH_NAME),
					"params" => array(
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Title", SH_NAME),
						   "param_name" => "title",
						   "description" => __("Enter Title for Skills Section", SH_NAME)
						),
						array(
						   "type" => "textfield",
						   "holder" => "div",
						   "class" => "",
						   "heading" => __("Number", SH_NAME),
						   "param_name" => "number",
						   "description" => __("Enter Number", SH_NAME)
						),
					
					),
				);		
/*----------------------------------------------------------------------------*/
