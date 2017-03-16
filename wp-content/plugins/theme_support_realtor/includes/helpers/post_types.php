<?php



class SH_Post_types

{

	

	function __construct()

	{

		// Hook into the 'init' action

		//add_action( 'init', array( $this, 'bistro_slider' ), 0 );
		$this->bistro_slider();
		

	}

	

	function labels( $names = '', $labels = array() )

	{

		$default =  array(

			'name'                => _x( 'Slides', 'Slides', SH_NAME ),

			'singular_name'       => _x( 'Slide', 'Slide', SH_NAME ),

			'menu_name'           => __( 'Slidr', SH_NAME ),

			'parent_item_colon'   => __( 'Parent Slide:', SH_NAME ),

			'all_items'           => __( 'All Slides', SH_NAME ),

			'view_item'           => __( 'View Slide', SH_NAME ),

			'add_new_item'        => __( 'Add New Slide', SH_NAME ),

			'add_new'             => __( 'New Slide', SH_NAME ),

			'edit_item'           => __( 'Edit Slide', SH_NAME ),

			'update_item'         => __( 'Update Slide', SH_NAME ),

			'search_items'        => __( 'Search Slides', SH_NAME ),

			'not_found'           => __( 'No Slides found', SH_NAME ),

			'not_found_in_trash'  => __( 'No Slides found in Trash', SH_NAME ),

		);

		

		foreach( $default as $k => $v ){

			$default[$k] = str_replace( array('Slide', 'Slides'), $names, $v);

		}

		$labels = wp_parse_args( $labels, $default );

		

		return $labels;

	}

	

	function args( $args = array() )

	{

		$default = array(

			'label'               => __( 'bistro_slider', SH_NAME ),

			'labels'              => array(),

			'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields'),

			'hierarchical'        => false,

			'public'              => true,

			'show_ui'             => true,

			'show_in_menu'        => true,

			'show_in_nav_menus'   => true,

			'show_in_admin_bar'   => true,

			'menu_position'       => 5,

			'menu_icon'           => '',

			'can_export'          => true,

			'has_archive'         => false,

			'exclude_from_search' => false,

			'publicly_queryable'  => true,

			'rewrite'             => array(),

			'capability_type'     => 'post',

		);

		$args = wp_parse_args( $args, $default );

		return $args;

	}

	

	// Register Custom Post Type

	function bistro_slider() {



		

		$settings = include( SH_TH_ROOT.'includes/resource/post_types.php');

		

		foreach( $options as $k => $v )

		{

			$labels = $this->labels(sh_set( $v, 'labels'), sh_set( $v, 'label_args' ) );	

	

			$rewrite = array(

				'slug'                => sh_set( $v, 'slug' ),

				'with_front'          => true,

				'pages'               => true,

				'feeds'               => false,

			);

		

			$args = $this->args( array('labels'=>$labels, 'supports'=>sh_set( $v, 'supports'), 'rewrite'=>$rewrite) );

			$args = wp_parse_args( sh_set( $v, 'args' ), $args );

			register_post_type( $k, $args );

		}



	}



}