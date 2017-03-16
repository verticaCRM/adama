<?php
class SH_Taxonomies
{
	
	var $team_cat_slug = '';
	var $services_cat_slug = '' ;
	var $testimonials_cat_slug = '' ;
	var $property_cat_slug = '' ;
	var $property_city_slug = '' ;
	var $property_agent_slug = '' ;
	
	function __construct()
	{
		// Hook into the 'init' action
		//add_action( 'init', array($this, 'taxonomies'), 0 );
		$theme_option = _WSH()->option() ; 
		$this->team_cat_slug = sh_set($theme_option , 'team_category_permalink' , 'team_category') ;
		$this->services_cat_slug = sh_set($theme_option , 'services_category_permalink' , 'services_category') ;
		$this->testimonials_cat_slug = sh_set($theme_option , 'testimonial_category_permalink' , 'testimonial_category') ;
		$this->property_cat_slug = sh_set($theme_option , 'property_category_permalink' , 'property_category');
		$this->property_city_slug = sh_set($theme_option , 'property_city_permalink' , 'property_city');
		$this->property_agent_slug = sh_set($theme_option , 'property_agent_permalink' , 'property_agent');
		$this->taxonomies();
	}
	
	// Register Custom Taxonomy
	function taxonomies()  {
		
		$labels = array(
			'name'                       => _x( 'Category', 'Property Category', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Category', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);
	
		$rewrite = array(
			'slug'                       => $this->property_cat_slug,
			'with_front'                 => true,
			'hierarchical'               => true,
		);
	
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
	
		register_taxonomy( 'property_category' , 'sh_property' , $args );
		
		$labels = array(
			'name'                       => _x( 'City', 'Property City', SH_NAME ),
			'singular_name'              => _x( 'City', 'City', SH_NAME ),
			'menu_name'                  => __( 'City', SH_NAME ),
			'all_items'                  => __( 'All Cities', SH_NAME ),
			'parent_item'                => __( 'Parent City', SH_NAME ),
			'parent_item_colon'          => __( 'Parent City:', SH_NAME ),
			'new_item_name'              => __( 'New City Name', SH_NAME ),
			'add_new_item'               => __( 'Add New City', SH_NAME ),
			'edit_item'                  => __( 'Edit City', SH_NAME ),
			'update_item'                => __( 'Update City', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Cities with commas', SH_NAME ),
			'search_items'               => __( 'Search Cities', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove City', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used City', SH_NAME ),
		);
	
		$rewrite = array(
			'slug'                       => $this->property_city_slug,
			'with_front'                 => true,
			'hierarchical'               => true,
		);
	
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
	
		register_taxonomy( 'property_city' , 'sh_property' , $args );

		
		$labels = array(
			'name'                       => _x( 'Agent', 'Property Agent', SH_NAME ),
			'singular_name'              => _x( 'Agent', 'Agent', SH_NAME ),
			'menu_name'                  => __( 'Agent', SH_NAME ),
			'all_items'                  => __( 'All Agents', SH_NAME ),
			'parent_item'                => __( 'Parent Agent', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Agent:', SH_NAME ),
			'new_item_name'              => __( 'New Agent Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Agent', SH_NAME ),
			'edit_item'                  => __( 'Edit Agent', SH_NAME ),
			'update_item'                => __( 'Update Agent', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Agents with commas', SH_NAME ),
			'search_items'               => __( 'Search Agents', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Agents', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Agents', SH_NAME ),
		);
	
		$rewrite = array(
			'slug'                       => $this->property_agent_slug,
			'with_front'                 => true,
			'hierarchical'               => true,
		);
	
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
	
		register_taxonomy( 'property_agent' , 'sh_property' , $args );

		
		
		$labels = array(
			'name'                       => _x( 'Category', 'Testimonial Category', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Category', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);
	
		$rewrite = array(
			'slug'                       => $this->testimonials_cat_slug,
			'with_front'                 => true,
			'hierarchical'               => true,
		);
	
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
	
		register_taxonomy( 'testimonial_category', 'sh_testimonial', $args );
		
		
		$labels = array(
			'name'                       => _x( 'Category', 'Team Category', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Category', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);
	
		$rewrite = array(
			'slug'                       => $this->team_cat_slug,
			'with_front'                 => true,
			'hierarchical'               => true,
		);
	
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
	
		register_taxonomy( 'team_category', 'sh_team', $args );
		
		$labels = array(
			'name'                       => _x( 'Category', 'Service Category', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Category', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);
	
		$rewrite = array(
			'slug'                       => $this->services_cat_slug,
			'with_front'                 => true,
			'hierarchical'               => true,
		);
	
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
	
		register_taxonomy('services_category', 'sh_services', $args );
		
		/*** Register faqs taxonomy faq_category */
		
	}
}