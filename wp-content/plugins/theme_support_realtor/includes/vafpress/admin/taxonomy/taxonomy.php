<?php
$options = array();

$options[] =  array(
	'id'          => '_sh_tax_seo_settings',
	'types'       => array('category', 'post_tag'),
	'title'       => __('SEO Settings', SH_NAME),
	'priority'    => 'high',
	'template'    => 
			array(

					array(
						'type' => 'toggle',
						'name' => 'seo_status',
						'label' => __('Enable SEO', SH_NAME),
						//'description' => __('Enable / disable seo settings for this post', SH_NAME),
					),
					array(
						'type' => 'textbox',
						'name' => 'title',
						'label' => __('Meta Title', SH_NAME),
						//'description' => __('Enter meta title or leave it empty to use default title', SH_NAME),
					),
					
					array(
						'type' => 'textarea',
						'name' => 'description',
						'label' => __('Meta Description', SH_NAME),
						'default' => '',
						//'description' => __('Enter meta description', SH_NAME),
					),
					array(
						'type' => 'textarea',
						'name' => 'keywords',
						'label' => __('Meta Keywords', SH_NAME),
						'default' => '',
						//'description' => __('Enter meta keywords', SH_NAME),
					),
					
				),
);

$options[] =  array(
	'id'          => _WSH()->set_term_key('category'),
	'types'       => array('category', 'post_tag'),
	'title'       => __('Post Category Settings', SH_NAME),
	'priority'    => 'high',
	'template'    => 
			array(

					array(
						'type' => 'textbox',
						'name' => 'header_title',
						'label' => __( 'Header Title', SH_NAME ),
					),
					array(
						'type' => 'upload',
						'name' => 'header_img',
						'label' => __( 'Header image', SH_NAME ),
					),
					array(
						'type' => 'radioimage',
						'name' => 'layout',
						'label' => __('Page Layout', SH_NAME),
						//'description' => __('Choose the layout for blog pages', SH_NAME),
						'items' => array(
							array(
								'value' => 'left',
								'label' => __('Left Sidebar', SH_NAME),
								'img' => get_template_directory_uri().'/includes/vafpress/public/img/2cl.png',
							),
							array(
								'value' => 'right',
								'label' => __('Right Sidebar', SH_NAME),
								'img' => get_template_directory_uri().'/includes/vafpress/public/img/2cr.png',
							),
							array(
								'value' => 'full',
								'label' => __('Full Width', SH_NAME),
								'img' => get_template_directory_uri().'/includes/vafpress/public/img/1col.png',
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

//agent taxonomy
$options[] =  array(
	'id'          => _WSH()->set_term_key('property_agent'),
	'types'       => array('property_agent'),
	'title'       => __('property Category Settings', SH_NAME),
	'priority'    => 'high',
	'template'    => 
			array(
					array(
						'type' => 'upload',
						'name' => 'agent_img',
						'label' => __( 'Agent image', SH_NAME ),
					),
					array(
						'type' => 'textbox',
						'name' => 'facebook_link',
						'label' => __( 'Facebook Link', SH_NAME ),
					),
					array(
						'type' => 'textbox',
						'name' => 'twitter_link',
						'label' => __( 'Twitter Link', SH_NAME ),
					),
					array(
						'type' => 'textbox',
						'name' => 'google_plus_link',
						'label' => __( 'Google Plus Link', SH_NAME ),
					),
					array(
						'type' => 'textbox',
						'name' => 'linked_in_link',
						'label' => __( 'Linked in Link', SH_NAME ),
					),
					array(
						'type' => 'textbox',
						'name' => 'phone',
						'label' => __( 'Phone Number', SH_NAME ),
					),
					array(
						'type' => 'textbox',
						'name' => 'email',
						'label' => __( 'Email', SH_NAME ),
					),
					
				),
);


 return $options;


/**
 * EOF
 */