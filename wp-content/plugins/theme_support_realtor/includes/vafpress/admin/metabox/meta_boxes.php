<?php
$options = array();
$options[] = array(
	'id'          => '_sh_seo_settings',
	'types'       => array('post', 'page', 'product', 'sh_services', 'sh_team', 'sh_portfolio'),
	'title'       => __('SEO Settings', SH_NAME),
	'priority'    => 'low',
	'template'    => 
			array(
					
					array(
						'type' => 'toggle',
						'name' => 'seo_status',
						'label' => __('Enable SEO', SH_NAME),
						'description' => __('Enable / disable seo settings for this post', SH_NAME),
					),
					array(
						'type' => 'textbox',
						'name' => 'title',
						'label' => __('Meta Title', SH_NAME),
						'description' => __('Enter meta title or leave it empty to use default title', SH_NAME),
					),
					
					array(
						'type' => 'textarea',
						'name' => 'description',
						'label' => __('Meta Description', SH_NAME),
						'default' => '',
						'description' => __('Enter meta description', SH_NAME),
					),
					array(
						'type' => 'textarea',
						'name' => 'keywords',
						'label' => __('Meta Keywords', SH_NAME),
						'default' => '',
						'description' => __('Enter meta keywords', SH_NAME),
					),
				),
); /** SEO fields for custom posts and pages */
$options[] = array(
	'id'          => '_sh_layout_settings',
	'types'       => array('post', 'page', 'sh_property', 'sh_services', ),
	'title'       => __('Layout Settings', SH_NAME),
	'priority'    => 'high',
	'template'    => 
			array(
					
					array(
						'type' => 'radioimage',
						'name' => 'layout',
						'label' => __('Page Layout', SH_NAME),
						'description' => __('Choose the layout for blog pages', SH_NAME),
						'items' => array(
							array(
								'value' => 'left',
								'label' => __('Left Sidebar', SH_NAME),
								'img' => SH_TH_URL.'/includes/vafpress/public/img/2cl.png',
							),
							array(
								'value' => 'right',
								'label' => __('Right Sidebar', SH_NAME),
								'img' => SH_TH_URL.'/includes/vafpress/public/img/2cr.png',
							),
							array(
								'value' => 'full',
								'label' => __('Full Width', SH_NAME),
								'img' => SH_TH_URL.'/includes/vafpress/public/img/1col.png',
							),
							
						),
					),
					
					array(
						'type' => 'select',
						'name' => 'sidebar',
						'label' => __('Sidebar', SH_NAME),
						'default' => '',
						'items' => sh_get_sidebars(true)	
					),
				),
);
$options[] = array(
	'id'          => '_sh_header_settings',
	'types'       => array('post', 'page', 'product', 'sh_portfolio'),
	'title'       => __('Header Settings', SH_NAME),
	'priority'    => 'high',
	'template'    => 
			array(
					
					
					array(
						'type' => 'upload',
						'name' => 'bg_image',
						'label' => __('Header Background Image', SH_NAME),
						'description' => __('Choose the header background image', SH_NAME),
					),
					array(
						'type' => 'textbox',
						'name' => 'header_title',
						'label' => __('Header Title', SH_NAME),
						'description' => __('Enter header title', SH_NAME),
					),
					array(
						'type' => 'notebox',
						'name' => 'nb_2',
						'label' => __('Info ', SH_NAME),
						'description' => __('Below option will only work on pages and VC page template', SH_NAME),
						'status' => 'info',
					),
					array(
						'type' => 'toggle',
						'name' => 'bread_crumb',
						'label' => __('Show/Hide breadcrumb on VC page', SH_NAME),
						'description' => __('Only work with VC Page template', SH_NAME),
					),
				),
);
$options[] =  array(
	'id'          => _WSH()->set_meta_key('post'),
	'types'       => array('post'),
	'title'       => __('Post Settings', SH_NAME),
	'priority'    => 'high',
	'template'    => 
			array(		
					array(
						'type' => 'toggle',
						'name' => 'top_posts',
						'label' => __('Show/Hide top posts', SH_NAME),
						'description' => __('Enable / disable seo Top post', SH_NAME),
					),
					array(
							 'type'      => 'group',
							 'repeating' => true,
							 'length'    => 1,
							 'name'      => 'sh_gallery_imgs',
							 'title'     => __('Gallery images', SH_NAME),
							 'fields'    => array(
								array(
							   'type' => 'upload',
							   'name' => 'gallery_image',
							   'label' => __('Gallery Image', SH_NAME),
							   'description' => __('Choose the Gallery images', SH_NAME),
							  ),
							 ),
							), 
					array(
						'type' => 'textarea',
						'name' => 'video',
						'label' => __('Video Embed Code', SH_NAME),
						'default' => '',
						'description' => __('If post format is video then this embed code will be used in content', SH_NAME)
					),
					array(
						'type' => 'textarea',
						'name' => 'audio',
						'label' => __('Audio Embed Code', SH_NAME),
						'default' => '',
						'description' => __('If post format is AUDIO then this embed code will be used in content', SH_NAME)
					),
					array(
						'type' => 'textarea',
						'name' => 'quote',
						'label' => __('Quote', SH_NAME),
						'default' => '',
						'description' => __('If post format is quote then the content in this textarea will be displayed', SH_NAME)
					),
							
					
			),
);
/* Page options */
/** Team Options*/
$options[] =  array(
	'id'          => _WSH()->set_meta_key('sh_team'),
	'types'       => array('sh_team'),
	'title'       => __('Team Options', SH_NAME),
	'priority'    => 'high',
	'template'    => array(
	
				array(
					'type' => 'textbox',
					'name' => 'designation',
					'label' => __('Designation', SH_NAME),
					'default' => 'CEO',
				),
				array(
					'type'      => 'group',
					'repeating' => true,
					'length'    => 1,
					'name'      => 'sh_team_social',
					'title'     => __('Social Profile', SH_NAME),
					'fields'    => array(
						
						array(
							'type' => 'fontawesome',
							'name' => 'social_icon',
							'label' => __('Social Icon', SH_NAME),
							'default' => '',
						),
						array(
							'type' => 'textbox',
							'name' => 'title',
							'label' => __('Title', SH_NAME),
							'default' => '',
						),
						
						array(
							'type' => 'textbox',
							'name' => 'social_link',
							'label' => __('Link', SH_NAME),
							'default' => '#',
							
						),
						
						
					),
				),
	),
);
/** Testimonial Options*/
$options[] =  array(
	'id'          => _WSH()->set_meta_key('sh_testimonial'),
	'types'       => array('sh_testimonial'),
	'title'       => __('Testimonials Options', SH_NAME),
	'priority'    => 'high',
	'template'    => array(
				
				array(
					'type' => 'textbox',
					'name' => 'location',
					'label' => __('Location', SH_NAME),
					'default' => 'Sydney, Australia',
				),
				
	),
);
/** Projects Options*/
$options[] =  array(
	'id'          => _WSH()->set_meta_key('sh_portfolio'),
	'types'       => array('sh_portfolio'),
	'title'       => __('Projects Options', SH_NAME),
	'priority'    => 'high',
	'template'    => array(
				array(
					'type' => 'textbox',
					'name' => 'project_detail_title',
					'label' => __('Project Detail Section Title', SH_NAME),
					'default' => '',
					'description' => __('Project Details', SH_NAME)
				),
				array(
					'type'      => 'group',
					'repeating' => true,
					'sortable'  => true,
					'name'      => 'extra_detail',
					'title'     => __('Extra Portfolio Details', SH_NAME),
					'fields'    => array(
						array(
							'type'  => 'textbox',
							'name'  => 'label',
							'label' => __('Label', SH_NAME),
						),
						array(
							'type'  => 'textbox',
							'name'  => 'value',
							'label' => __('Value', SH_NAME),
						),
						
					),
				
				),
				array(
					'type'      => 'group',
					'repeating' => true,
					'sortable'  => true,
					'name'      => 'accordion',
					'title'     => __('Services Accordion', SH_NAME),
					'fields'    => array(
						array(
							'type'  => 'textbox',
							'name'  => 'title',
							'label' => __('Title', SH_NAME),
						),
						
						array(
							'type'                       => 'textarea',
							'label'                      => __('Content', SH_NAME),
							'name'                       => 'content',
							'use_external_plugins'       => 1,
							'disabled_externals_plugins' => 'vp_sc_button',
							'disabled_internals_plugins' => '',
							'validation'                 => 'required',
						),
					),
				
				),
				array(
					'type'      => 'group',
					'repeating' => true,
					'sortable'  => true,
					'name'      => 'portfolio_images',
					'title'     => __('Portfolio Images', SH_NAME),
					'fields'    => array(
						array(
							'type'  => 'upload',
							'name'  => 'image',
							'label' => __('Image', SH_NAME),
						),
						
					),
				
				),
			    array(
					'type' => 'textarea',
					'name' => 'video',
					'label' => __('Video Embed Code', SH_NAME),
					'default' => '',
					'description' => __('If Project Type is video then this embed code will be used in content', SH_NAME),
				),
			    array(
					'type' => 'textarea',
					'name' => 'audio',
					'label' => __('Audio Embed Code', SH_NAME),
					'default' => '',
					'description' => __('If Project Type is AUDIO then this embed code will be used in content', SH_NAME),
				),
				
									
	),
);
 $options[] =  array(
	'id'          => _WSH()->set_meta_key('sh_property'),
	'types'       => array('sh_property'),
	'title'       => __('Property Settings', SH_NAME),
	'priority'    => 'high',
	'template'    => array(
					
					
				array(
					 'type'      => 'group',
					 'repeating' => true,
					 'length'    => 1,
					 'name'      => 'sh_gallery_imgs',
					 'title'     => __('Gallery images', SH_NAME),
					 'fields'    => array(
						array(
					   'type' => 'upload',
					   'name' => 'gallery_image',
					   'label' => __('Gallery Image', SH_NAME),
					   'description' => __('Choose the Gallery images', SH_NAME),
					  ),
					 ),
				),
				array(
					'type' => 'select',
					'name' => 'property_status',
					'label' => __('Property status', SH_NAME),
					'description' => __('Property status sale/rent', SH_NAME),
					'items' => array( 
						array(
								'value'=>'sale',
								'label'=>'For Sale'
							), 
						array(
								'value'=>'rent',
								'label'=>'For Rent'
							), 
						),
					'default' => 'sale'
				),
				array(
					'type' => 'textbox',
					'name' => 'price',
					'label' => __('Price', SH_NAME),
					'default' => '',
				),
				array(
					'type' => 'textbox',
					'name' => 'area',
					'label' => __('Area', SH_NAME),
					'default' => '',
				),
				array(
					'type' => 'textbox',
					'name' => 'lat',
					'label' => __('Lattitude', SH_NAME),
					'default' => '',
				),
				array(
					'type' => 'textbox',
					'name' => 'long',
					'label' => __('Longitude', SH_NAME),
					'default' => '',
				),
				array(
					'type' => 'select',
					'name' => 'property_type',
					'label' => __('Property type', SH_NAME),
					'description' => __('Property type plaza/house', SH_NAME),
					'items' => array( 
						array(
								'value'=>'plaza',
								'label'=>'Plaza'
							), 
						array(
								'value'=>'house',
								'label'=>'House'
							),
						array(
								'value'=>'factry',
								'label'=>'Factory'
							),
						array(
								'value'=>'Appartment',
								'label'=>'appartment'
							),
						array(
								'value'=>'House',
								'label'=>'house'
							),
						array(
								'value'=>'Villa',
								'label'=>'villa'
							),
						array(
								'value'=>'Land',
								'label'=>'land'
							),			 
						),
					'default' => 'house'
				),
				array(
					'type' => 'textbox',
					'name' => 'bedrooms',
					'label' => __('No. of Bedrooms', SH_NAME),
					'default' => '',
				),
				array(
					'type' => 'textbox',
					'name' => 'bathrooms',
					'label' => __('No. of Bathrooms', SH_NAME),
					'default' => '',
				),
				array(
					'type' => 'textarea',
					'name' => 'address',
					'label' => __('Address', SH_NAME),
					'default' => '',
					'description' => __('Enter Address', SH_NAME),
				),
				array(
					'type' => 'textbox',
					'name' => 'zip_code',
					'label' => __('Zip Code', SH_NAME),
					'default' => '',
					'description' => __('Enter Zip code', SH_NAME),
				),
				array(
					'type' => 'textarea',
					'name' => 'features',
					'label' => __('Property Features', SH_NAME),
					'default' => '',
					'description' => __('Property features 1 per line.', SH_NAME)
				),
				array(
					'type' => 'toggle',
					'name' => 'related_properties',
					'label' => __('Enable/Disbale Related Propertise', SH_NAME),
					'description' => __('Enable/Disbale Related Propertise for this post', SH_NAME),
				),
				
	),
);
$options[] =  array(
	'id'          => _WSH()->set_meta_key('sh_services'),
	'types'       => array( 'sh_services' ),
	'title'       => __('Services Settings', SH_NAME),
	'priority'    => 'high',
	'template'    => 
			array(
				array(
					'type' => 'fontawesome',
					'name' => 'service_icon',
					'label' => __('Service Icon', SH_NAME),
					'default' => '',
				),
				array(
					'type' => 'upload',
					'name' => 'small_image',
					'label' => __('Services small Image', SH_NAME),
					'description' => __('Add Another image to services', SH_NAME),
				),
			    array(
					'type' => 'upload',
					'name' => 'large_image',
					'label' => __('Services large Image', SH_NAME),
					'description' => __('Add Another image to services', SH_NAME),
				),
				array(
					'type' => 'textbox',
					'name' => 'readmore_link',
					'label' => __('Read More Button Link', SH_NAME),
					'description' => __('Enter the Read more Link', SH_NAME),
					'default' => __('#', SH_NAME),
				),
				
			),
);
/**
 * EOF
 */
 
 
 return $options;