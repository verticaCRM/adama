<?php

$theme_option = get_option(SH_NAME.'_theme_options') ; 

$team_slug = sh_set($theme_option , 'team_permalink' , 'team') ;

$services_slug = sh_set($theme_option , 'services_permalink' , 'services') ;

$testimonial_slug = sh_set($theme_option , 'testimonial_permalink' , 'testimonials') ;

$property_slug = sh_set($theme_option , 'property_permalink' , 'property') ;


$options = array();
$options['sh_services'] = array(
								'labels' => array(__('Services', SH_NAME), __('Services', SH_NAME)),
								'slug' => $services_slug ,
								'label_args' => array('menu_name' => __('Services', SH_NAME)),
								'supports' => array( 'title' , 'editor' , 'thumbnail' ),
								'label' => __('Services', SH_NAME),
								'args'=>array(
										'menu_icon'=>'dashicons-slides' , 
										'taxonomies'=>array('services_category')
								)
							);
$options['sh_team'] = array(
								'labels' => array(__('Member', SH_NAME), __('Member', SH_NAME)),
								'slug' => $team_slug ,
								'label_args' => array('menu_name' => __('Teams', SH_NAME)),
								'supports' => array( 'title', 'editor' , 'thumbnail'),
								'label' => __('Member', SH_NAME),
								'args'=>array(
											'menu_icon'=>'dashicons-groups' , 
											'taxonomies'=>array('team_category')
								)
							);
$options['sh_testimonial'] = array(
								'labels' => array(__('Testimonial', SH_NAME), __('Testimonial', SH_NAME)),
								'slug' => $testimonial_slug ,
								'label_args' => array('menu_name' => __('Testimonials', SH_NAME)),
								'supports' => array( 'title' , 'editor' , 'thumbnail' ),
								'label' => __('Testimonial', SH_NAME),
								'args'=>array(
										'menu_icon'=>'dashicons-slides' , 
										'taxonomies'=>array('testimonial_category')
								)
							);							
$options['sh_property'] = array(
								'labels' => array(__('Property', SH_NAME), __('Property', SH_NAME)),
								'slug' => $property_slug ,
								'label_args' => array('menu_name' => __('Property', SH_NAME)),
								'supports' => array( 'title' , 'editor' , 'thumbnail' ),
								'label' => __('Property', SH_NAME),
								'args'=>array(
										'menu_icon'=>'dashicons-slides' , 
										'taxonomies'=>array('property_category')
								)
							);
							
							
																					
