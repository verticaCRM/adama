<?php

return array(

	'About' => array(
		'elements'=> array(

			'all_controls' => array(
				'title'   => 'About Controls',
				'code'    => '[sh_about]',
				'attributes' => array(
					array(
						 'type' => 'textbox',
						'name' => 'author',
						'label' => __( 'Author', SH_NAME ),
						'description' => __( 'Enter the Author name', SH_NAME ),
						'default' => 'Fliz' 
					),
					array(
						'type' => 'wpeditor',
						'name' => 'title',
						'label' => __('Title', 'vp_textdomain'),
						'description' => __('Wordpress tinyMCE editor.', 'vp_textdomain'),
						'use_external_plugins' => '0',
						'disabled_externals_plugins' => '',
						'disabled_internals_plugins' => '',
					),
					array(
						 'type' => 'textbox',
						'name' => 'title_link',
						'label' => __( 'Title Link', SH_NAME ),
						'description' => __( 'Enter the Title Link', SH_NAME ),
						'default' => 'abc.com' 
					),
					array(
						'type' => 'wpeditor',
						'name' => 'tagline',
						'label' => __('Tagline', 'vp_textdomain'),
						'description' => __('Wordpress tinyMCE editor.', 'vp_textdomain'),
						'use_external_plugins' => '0',
						'disabled_externals_plugins' => '',
						'disabled_internals_plugins' => '',
					),
					array(
						'type' => 'upload',
						'name' => 'img',
						'label' => __('Image', 'vp_textdomain'),
						'description' => __('Image for the section', 'vp_textdomain'),
						'default' => 'http://placehold.it/70x70',
					),
					array(
						'type' => 'wpeditor',
						'name' => 'content',
						'label' => __('Short html Text', 'vp_textdomain'),
						'description' => __('Enter content, you can use html tags', 'vp_textdomain'),
						'use_external_plugins' => '0',
						'disabled_externals_plugins' => '',
						'disabled_internals_plugins' => '',
					),
					
					
				),
			),
		),
	),
	'Contact' => array(
		'elements'=> array(

			'all_controls' => array(
				'title'   => 'Contact Controls',
				'code'    => '[sh_contact]',
				'attributes' => array(
					array(
						'name'  => 'small_title',
						'type'  => 'textbox',
						'label' => __('Small Title', SH_NAME),
						'description' => __("Enter title or leave blank if don\'t want to show title.", SH_NAME),
						'default' => '',
					),
					array(
						'name'  => 'main_title',
						'type'  => 'textbox',
						'label' => __('Main Title', SH_NAME),
						'description' => __("Enter title or leave blank if don\'t want to show title.", SH_NAME),
						'default' => '',
					),
					array(
						'name'  => 'title_link',
						'type'  => 'textbox',
						'label' => __('Title Link', SH_NAME),
						'description' => __('Enter Title Link', SH_NAME),
						'default' => '',
					),
					array(
						'type' => 'wpeditor',
						'name' => 'tagline',
						'label' => __('Tagline', 'vp_textdomain'),
						'description' => __('Wordpress tinyMCE editor.', 'vp_textdomain'),
						'use_external_plugins' => '0',
						'disabled_externals_plugins' => '',
						'disabled_internals_plugins' => '',
					),
					array(
						'type' => 'wpeditor',
						'name' => 'content',
						'label' => __('Short html Text', 'vp_textdomain'),
						'description' => __('Enter content, you can use html tags', 'vp_textdomain'),
						'use_external_plugins' => '0',
						'disabled_externals_plugins' => '',
						'disabled_internals_plugins' => '',
					),
					
				),
			),
		),
	),

);

/**
 * EOF
 */