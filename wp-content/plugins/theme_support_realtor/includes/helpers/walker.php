<?php 





/**

 * @package MegaMain

 * @subpackage MegaMain

 * @since mm 1.0

 */

	class MegaMenuWalker extends Walker_Nav_Menu {

		

		

		function ntab( $number_of_tabs = 0, $newline = 'true' ) {

			$ntab = ( $newline === 'true' ) ? "\n" : "";

			for ($i = 0; $number_of_tabs > $i; $i++) {

				$ntab .= "\t";

			}

			return $ntab;

		}

		

		function bootstrap_menu( &$output, $args, $item, $depth )

		{

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';



			$submenu_type = get_post_meta( $args->menu_main_parent, '_sh_menu_item_submenu_type', true);

			

			/**

			 * Dividers, Headers or Disabled

			 * =============================

			 * Determine whether the item is a Divider, Header, Disabled or regular

			 * menu item. To prevent errors we use the strcasecmp() function to so a

			 * comparison that is not case sensitive. The strcasecmp() function returns

			 * a 0 if the strings are equal.

			 */

			if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {

				$output .= $indent . '<li role="presentation" class="divider">';

			} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {

				$output .= $indent . '<li role="presentation" class="divider">';

			} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {

				$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );

			} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {

				$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';

			} else {

	

				$class_names = $value = '';

	

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;

				$classes[] = 'menu-item-' . $item->ID;

				

				if( $submenu_type == 'multicolumn_dropdown' && $depth == 0 ) $classes[] = 'dropdown wps-full';

				else if( $depth == 0 ) $classes[] = 'dropdown hover-it';

				

				else if( $depth > 0 ) $classes[] = 'dropdown-submenu column';

	

				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

	

				if ( $args->has_children )

					$class_names .= ' dropdown';

	

				if ( in_array( 'current-menu-item', $classes ) )

					$class_names .= ' active';

	

				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

	

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );

				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

	

				$output .= $indent . '<li' . $id . $value . $class_names .'>';

	

				$atts = array();

				$atts['title']  = ! empty( $item->title )	? $item->title	: '';

				$atts['target'] = ! empty( $item->target )	? $item->target	: '';

				$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

	

				// If item has_children add atts to a.

				if ( $args->has_children && $depth === 0 ) {

					$atts['href']   		= '#';

					$atts['data-toggle']	= 'dropdown';

					$atts['class']			= 'dropdown-toggle';

					$atts['aria-haspopup']	= 'true';

				} else {

					$atts['href'] = ! empty( $item->url ) ? $item->url : '';

				}

	

				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

	

				$attributes = '';

				foreach ( $atts as $attr => $value ) {

					if ( ! empty( $value ) ) {

						$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );

						$attributes .= ' ' . $attr . '="' . $value . '"';

					}

				}

	

				$item_output = $args->before;

	

				/*

				 * Glyphicons

				 * ===========

				 * Since the the menu item is NOT a Divider or Header we check the see

				 * if there is a value in the attr_title property. If the attr_title

				 * property is NOT null we apply it as the class name for the glyphicon.

				 */

				if ( ! empty( $item->attr_title ) )

					$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';

				else

					$item_output .= '<a'. $attributes .'>';



				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

				if( $args->has_children && 0 < $depth ) $item_output .= '<span class="nav-arrow fa fa-angle-right"></span>';

				//$item_output .= ( $args->has_children && 0 === $depth ) ? ' </a>' : '</a>';

				$item_output .= '</a>';

				$item_output .= $args->after;

	

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

			}

			

		}

		

		/**

		 * default_menu_item 

		 */

		function default_menu_item( &$output, $args, $item, $depth ) 

		{

			

			$args = (object)$args;

			$item = (object)$item;

			$indent = str_repeat("\t", $depth);

			$class_names = $value = '';

			

			$submenu_type = get_post_meta( $args->menu_main_parent, '_sh_menu_item_submenu_type', true);

			

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$classes[] = 'menu-item-' . $item->ID;



			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			$args->_submenu_type = ( substr_count( $args->_submenu_type,  '_menu_widgets_area_' ) == 1 ) 

				? 'widgets_dropdown' 

				: $args->_submenu_type;

			$class_names .= ' ' . implode(' ', array( $args->_submenu_type, 'megamenu' . $args->_submenu_columns ) );

			//$class_names = str_replace( '  ', ' ', $class_names );

			if( $submenu_type == 'multicolumn_dropdown' && $depth == 0 ) $class_names .= ' dropdown yamm-fw hover-it';

			



			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );

			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			if ( $depth == '1' && get_post_meta( $args->menu_main_parent, '_sh_menu_item_submenu_type', true) == 'multicolumn_dropdown' ) {

				

				$columns = get_post_meta( $args->menu_main_parent, '_sh_menu_columns', true) 

					? get_post_meta( $args->menu_main_parent, '_sh_menu_columns', true) 

					: 1;

				$class_names .= ' col-sm-12';

				$item_width = ' style="width:' . ( 100 / $columns ) . '%;"'; 

			} else {

				$item_width = '';

			}



			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$output .= $this->ntab( $depth ) . '<li' . $id . $value . $class_names . $item_width .'>';



			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';

			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';

			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

			//$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

			$attributes .= ! empty( $item->url )        ? ' href="#"' : '';



			$attributes .= !( $submenu_type == 'multicolumn_dropdown' && $depth == 0 ) ? ' class="dropdown-toggle" data-toggle="dropdown" ' : '';



			$item_output = '';



			//$item_output .= $this->ntab( $depth + 2 ) . '<span class="link_content">';

			//$item_output .= $this->ntab( $depth + 3 ) . '<span class="link_text">';

			//$item_output .= $this->ntab( $depth + 2 ) . apply_filters( 'the_title', $item->title, $item->ID );

			/*if ( !empty( $item->descr ) ) {

				$item_output .= $this->ntab( $depth + 4 ) . '<span class="link_descr">';

				$item_output .= $this->excerpt( $item->descr );

				$item_output .= $this->ntab( $depth + 4 ) . '</span>';

			}*/

			

			if( $submenu_type == 'multicolumn_dropdown' && $depth !== 1 ) {

				$item_output .= $args->before;

				$item_output .= '<a'. $attributes .'>';

				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

				

				$item_output .= '</a>';

				$item_output .= $args->after;

				//$item_output .= $this->ntab( $depth + 3 ) . '</span>';

				//$item_output .= $this->ntab( $depth + 2 ) . '</span>';

			}



			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}



		/**

		 * grid_dropdown 

		 */

		function grid_dropdown( &$output, $args, $item, $depth ) 

		{

			

			exit('ssss');

			

			$args = (object)$args;

			$item = (object)$item;

//			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';



			$class_names = $value = '';



			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$classes[] = 'menu-item-' . $item->ID;



			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			$class_names .= ' ' . implode(' ', array( $args->_submenu_type, $args->_submenu_drops_side, /*$args->_submenu_disable_icons, */'columns' . $args->_submenu_columns ) );

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';



			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );

			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';



			$columns = get_post_meta( $args->menu_main_parent, '_submenu_columns', true) 

				? get_post_meta( $args->menu_main_parent, '_submenu_columns', true) 

				: 2;

			$enable_full_width = get_post_meta( $args->menu_main_parent, '_submenu_columns', true);

			$item->descr = get_post_meta( $item->ID, '_item_descr', true );

			$_submenu_enable_full_width = is_array( get_post_meta( $args->menu_main_parent, '_submenu_enable_full_width', true ) ) 

				? get_post_meta( $args->menu_main_parent, '_submenu_enable_full_width', true ) 

				: array();

			$dropdown_width = ( in_array( 'true', $_submenu_enable_full_width ) ) 

				? 1140

				: 450;

			$item_width_height = 100 / $columns;

			$img_width_height = floor( 1140 / $columns ); 

			$details_height = floor( $dropdown_width / 3 );

			$item->icon = get_post_meta( $item->ID, '_item_icon', true)

				? get_post_meta( $item->ID, '_item_icon', true)

				: '';



			$output .= $this->ntab( $depth ) . '<li' . $id . $value . $class_names .' style="width:' . $item_width_height . '%;">';



			if ( get_the_post_thumbnail( $item->object_id, 'thumbnail' ) != false ) {

				$item_icon = mm_image_pro::processed_image( $img_args = array( 'post_id' => $item->object_id, 'width'=> $img_width_height, 'height' => $img_width_height, 'permalink' => get_permalink( $item->object_id ), 'icon' => $item->icon, 'cover' => 'icon' ) );

			} else {

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';

				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';

//                $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

				$attributes .= ( !empty( $item->url ) && get_post_meta( $item->ID, '_disable_link', true) != '1' ) ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

				$attributes .= ' class="item_link ' . ( !empty( $link_class ) ? $link_class : '' ) . ' witout_img"';



				$item_icon = $this->ntab( $depth + 1 ) . '<a'. $attributes .'>';

				$item_icon .= $this->ntab( $depth + 2 ) . '<i class="' . $item->icon . '"></i> ';            

				$item_icon .= $this->ntab( $depth + 2 ) . '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABdJREFUeNpi/P//PwM6YGLAAigUBAgwADZQAwcsn51XAAAAAElFTkSuQmCC" alt="placeholder"/>';

				$item_icon .= $this->ntab( $depth + 1 ) . '</a>';

			}



			$item_output = '';

//			$item_output .= $args->before;

			$item_output .= $item_icon;

//			$item_output .= $args->after;

			$item_output .= $this->ntab( $depth + 1 ) . '<div class="post_details">';

			if ( get_the_post_thumbnail( $item->object_id, 'thumbnail' ) != false ) {

				$item_output .= mm_image_pro::processed_image( $img_args = array( 'post_id' => $item->object_id, 'width'=> $dropdown_width, 'height' => $details_height, 'permalink' => get_permalink( $item->object_id ), 'icon' => $item->icon, 'cover' => 'icon' ) );

			}

			$item_output .= $this->ntab( $depth + 2 ) . '<div class="post_icon pull-left">';

			$item_output .= $this->ntab( $depth + 2 ) . '<i class="' . $item->icon . '"></i>';

			$item_output .= $this->ntab( $depth + 2 ) . '</div>';

			$item_output .= $this->ntab( $depth + 2 ) . '<div class="post_title">';

//			$item_output .= $this->ntab( $depth + 3 ) . '<a rel="bookmark" href="' . esc_url( get_permalink($item->object_id) ) . '" title="' . esc_attr( apply_filters( 'the_title', $item->title, $item->object_id ) ) . '">' . apply_filters( 'the_title', $item->title, $item->object_id ) . '</a>';

			$item_output .= $this->ntab( $depth + 3 ) . apply_filters( 'the_title', $item->title, $item->object_id );

			$item_output .= $this->ntab( $depth + 2 ) . '</div>';

			if ( isset( $item->descr ) && $item->descr != '' ) {

				$item_output .= $this->ntab( $depth + 2 ) . '<div class="post_description">';

				$item_output .= $this->excerpt( $item->descr );

				$item_output .= $this->ntab( $depth + 2 ) . '</div>';

			}

			$item_output .= $this->ntab( $depth + 1 ) . '</div><!-- /.post_details -->';



			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}



		/**

		 * post_type_dropdown 

		 */

		function post_type_dropdown( &$output, $args, $depth ) {

			global $mega_main_menu;

			$args = (array)$args;

			global $wpdb; //, $shortname 

			$showposts = get_post_meta( $args['menu_main_parent'], '_submenu_columns', true) * 2;

			$post_type = get_post_meta( $args['menu_main_parent'], '_submenu_post_type', true);

			$query_args = array(

				'post_type' => $post_type,

				'showposts' => $showposts,

				'nopaging' => false,

				'post_status' => 'publish',

				'ignore_sticky_posts' => true,

				'suppress_filters' => false

			);

			if ( strripos( $post_type, '/' ) !== false ) {

				$post_type_taxonomy = explode( '/', $post_type );

				$query_args['post_type'] = $post_type_taxonomy[ 0 ];

				$taxonomy = explode( '=', $post_type_taxonomy[ 1 ] );

				$query_args['tax_query'] = array(

					array(

						'taxonomy' => $taxonomy[ 0 ],

						'field' => 'slug',

						'terms' => $taxonomy[ 1 ],

					)

				);

			} else {

				$query_args['post_type'] = $post_type;

			}



			$recent_query = get_posts( $query_args );



			if ( count( $recent_query ) ) {

				$columns = get_post_meta( $args['menu_main_parent'], '_submenu_columns', true) ? get_post_meta( $args['menu_main_parent'], '_submenu_columns', true) : 2;

				$enable_full_width = get_post_meta( $args['menu_main_parent'], '_submenu_columns', true);

				$_submenu_enable_full_width = is_array( get_post_meta( $args['menu_main_parent'], '_submenu_enable_full_width', true ) ) 

					? get_post_meta( $args['menu_main_parent'], '_submenu_enable_full_width', true ) 

					: array();

				$dropdown_width = ( in_array( 'true', $_submenu_enable_full_width ) ) 

					? 1140 

					: 450;

				$item_width_height = 100 / $columns;

				$img_width_height = floor( 1140 / $columns ); 

				$details_height = floor( $dropdown_width / 3 );



				foreach ( $recent_query as $key => $post_object ) {

					$post_icon = get_post_meta( $post_object->ID, 'mm_post_icon', true)

						? get_post_meta( $post_object->ID, 'mm_post_icon', true)

						: '';

					$output .= $this->ntab( $depth + 1 ) . '<li class="post_item" style="width:' . $item_width_height . '%;">';

					if ( wp_get_attachment_image_src( get_post_thumbnail_id( $post_object->ID ), 'full' ) ) {

						$output .= mm_image_pro::processed_image( $img_args = array( 'post_id' => $post_object->ID, 'width'=> $img_width_height, 'height' => $img_width_height, 'permalink' => get_permalink( $post_object->ID ), 'icon' => $post_icon, 'cover' => 'icon' ) );

					} else {

						$output .= $this->ntab( $depth + 2 ) . '<a class="item_link" href="' . get_permalink( $post_object->ID ) . '" title="' . apply_filters( 'the_title', $post_object->title, $post_object->ID ) . '">';

						$output .= $this->ntab( $depth + 3 ) . '<i class="' . $post_icon . '"></i>';

						$output .= $this->ntab( $depth + 3 ) . '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABdJREFUeNpi/P//PwM6YGLAAigUBAgwADZQAwcsn51XAAAAAElFTkSuQmCC" alt="placeholder"/>';

						$output .= $this->ntab( $depth + 2 ) . '</a>';

					}

					$output .= $this->ntab( $depth + 2 ) . '<div class="post_details">';

					if ( wp_get_attachment_image_src( get_post_thumbnail_id( $post_object->ID ), 'full' ) ) {

						$output .= mm_image_pro::processed_image( $img_args = array( 'post_id' => $post_object->ID, 'width'=> $dropdown_width, 'height' => $details_height, 'permalink' => get_permalink( $post_object->ID ), 'icon' => $post_icon, 'cover' => false ) );

					}

					$output .= $this->ntab( $depth + 3 ) . '<div class="post_icon">';

					$output .= $this->ntab( $depth + 4 ) . '<i class="' .$post_icon . '"></i>';

					$output .= $this->ntab( $depth + 3 ) . '</div>';

					$output .= $this->ntab( $depth + 3 ) . '<div class="post_title">';

					$output .= $this->ntab( $depth + 4 ) . apply_filters( 'the_title', $post_object->post_title, $post_object->ID );

					$output .= $this->ntab( $depth + 3 ) . '</div>';

					$output .= $this->ntab( $depth + 3 ) . '<div class="post_description">';

					$output .= $this->ntab( $depth + 4 ) . $this->excerpt( $post_object->post_content );

					$output .= $this->ntab( $depth + 3 ) . '</div>';

					$output .= $this->ntab( $depth + 2 ) . '</div><!-- /.post_details -->';

					$output .= $this->ntab( $depth + 1 ) . '</li><!-- /.post_item -->';

				} 

			}

//            $output .= '<span class="clearboth"></span><!-- /.clearboth -->';

		}



		/**

		 * custom_dropdown 

		 */

/* for better times

		function custom_dropdown( &$output, $args ) {

				$output .= '<div class="submenu_custom_content">' . do_shortcode( get_post_meta( $args['menu_main_parent'], '_submenu_custom_content', true) ) . '</div><!-- /.submenu_custom_content -->';

		}

*/

		/**

		 * widgets_dropdown 

		 */

		function widgets_dropdown( &$output, $args ) {

			ob_start();

				echo '<li>';

				dynamic_sidebar( $args['widgets_area_number'] );

				//echo '</li>';

				$output .= ob_get_contents();

			ob_end_clean();

		}



		function start_lvl( &$output, $depth = 0, $args = array() ) {

			

			$args = (object)$args;

			

			$submenu_type = get_post_meta( $args->menu_main_parent, '_sh_menu_item_submenu_type', true);

			$class = ( $depth == 0 || $submenu_type != 'multicolumn_dropdown') ? 'dropdown-menu' : 'sub-menu column';

			$output .= $this->ntab( $depth + 1 ) . '<ul class="'.$class.'">';

		}



		function end_lvl( &$output, $depth = 0, $args = array() ) {

			global $mega_main_menu;

			$args = (object)$args;

			$indent = str_repeat( "\t", $depth );

				$mmm_submenu_type = ( get_post_meta( $args->menu_main_parent, '_sh_menu_item_submenu_type', true) ) ? get_post_meta( $args->menu_main_parent, '_submenu_type', true) : 'default_dropdown';

				if ( $mmm_submenu_type == 'post_type_dropdown' ) {

					$args_submenu_type = array( 'menu_item_id' => $args->menu_item_id, 'menu_main_parent' => $args->menu_main_parent );

					call_user_func_array ( array( $this, 'post_type_dropdown' ), array( &$output, $args_submenu_type, $depth ) );

				}

				if ( strpos( $mmm_submenu_type,  '_menu_widgets_area_' ) == 0 && $depth == 0 ) {

					$args_submenu_type = array( 

						'menu_item_id' => $args->menu_item_id, 

						'menu_main_parent' => $args->menu_main_parent,

						'widgets_area_number' => $mmm_submenu_type,

					);

					call_user_func_array ( array( $this, 'widgets_dropdown' ), array( &$output, $args_submenu_type ) );

				}



			$output .= $this->ntab( $depth + 1 ) . '</ul><!-- /.mega_dropdown -->';

		}



		function start_el( &$output, $item, $depth = 0, $args = '', $id = 0 ) {

			

			global $mega_main_menu;

			$args = (object)$args;

			$item = (object)$item;

			$submenu_type = get_post_meta( $item->menu_item_parent, '_sh_menu_item_submenu_type', true);

			

			if ( $submenu_type == 'grid_dropdown'  ) {

				call_user_func_array ( array( $this, 'grid_dropdown' ), array( &$output, $args, $item, $depth ) );

			} else if ( $submenu_type == 'multicolumn_dropdown' ) {

				call_user_func_array ( array( $this, 'default_menu_item' ), array( &$output, $args, $item, $depth ) );

			} else {

				$menu_type = get_post_meta( $item->ID, '_sh_menu_item_submenu_type', true);

				if( $menu_type == 'sh_menu_widgets_area' ) {

					$widget = get_post_meta( $item->ID, '_sh_menu_sidebar', true);

					$args_submenu['widgets_area_number'] = $widget;

					call_user_func_array ( array( $this, 'widgets_dropdown' ), array( &$output, $args_submenu, $item, $depth ) );

				}

				else call_user_func_array ( array( $this, 'bootstrap_menu' ), array( &$output, $args, $item, $depth ) );

			}

		}



		function end_el( &$output, $item, $depth = 0, $args = '', $id = 0 ) {

			$output .= $this->ntab( $depth ) . '</li>';

		}



		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {



			$args[0] = (object)$args[0];

			$element = (object)$element;



			if ( !$element and !isset( $args[0]->menu_main_parent ) )

				return;



			$id_field = $this->db_fields['id'];



			// Display this element.

			if ( is_object( $args[0] ) )

			   $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

	

			//parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

			

			//display this element

			if ( is_array( $args[0] ) ) {

				$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );

			}



			$args[0]->menu_item_id = $element->ID;

			$args[0]->menu_item_parent = $element->menu_item_parent;

			if ( $element->menu_item_parent == 0 ) {

				$args[0]->menu_main_parent = $element->ID;

			}



			$args[0]->_submenu_type = ( get_post_meta( $element->ID, 'menu_item_submenu_type', true) ) 

				? get_post_meta( $element->ID,  'menu_item_submenu_type', true) 

				: 'default_dropdown';

			

			

			$args[0]->_submenu_columns = ( get_post_meta( $element->ID, '_sh_menu_columns', true) ) 

				? get_post_meta( $element->ID, '_sh_menu_columns', true)

				: '1';



			

			$mmm_submenu_type = ( get_post_meta( $args[0]->menu_main_parent,  'menu_item_submenu_type', true) ) 

				? get_post_meta( $args[0]->menu_main_parent, 'menu_item_submenu_type', true) 

				: 'default_dropdown';



			if ( ( ( $mmm_submenu_type != 'post_type_dropdown' ) || $element->ID == $args[0]->menu_main_parent ) ) {

				$cb_args = array_merge( array(&$output, $element, $depth), $args);

				call_user_func_array(array($this, 'start_el'), $cb_args);



				$id = $element->$id_field;



				// descend only when the depth is right and there are childrens for this element

				if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {



					foreach( $children_elements[ $id ] as $child ){



						if ( !isset($newlevel) ) {

							$newlevel = true;

							//start the child delimiter

							$cb_args = array_merge( array(&$output, $depth), $args);

							call_user_func_array(array($this, 'start_lvl'), $cb_args);

						}

						$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );

					}

					unset( $children_elements[ $id ] );

				} elseif ( substr_count( $mmm_submenu_type,  '_menu_widgets_area_' ) == 1 || $mmm_submenu_type == 'post_type_dropdown'  ) {

					$cb_args = array_merge( array(&$output, $depth), $args);

					call_user_func_array(array($this, 'start_lvl'), $cb_args);

					call_user_func_array(array($this, 'end_lvl'), $cb_args);

				}



				if ( isset($newlevel) && $newlevel ){

					//end the child delimiter

					$cb_args = array_merge( array(&$output, $depth), $args);

					call_user_func_array(array($this, 'end_lvl'), $cb_args);

				}

			} 



			//end this element

			$cb_args = array_merge( array(&$output, $element, $depth), $args);

			call_user_func_array(array($this, 'end_el'), $cb_args);

			

			$id_field = $this->db_fields['id'];



		}

	}

	

	



class MegaMenuWalkerEdit extends Walker_Nav_Menu  {

	

	/**

	 * @see Walker_Nav_Menu::start_lvl()

	 * @since 3.0.0

	 *

	 * @param string $output Passed by reference.

	 */

	function start_lvl(&$output, $depth = 0, $args = array()) {}



	/**

	 * @see Walker_Nav_Menu::end_lvl()

	 * @since 3.0.0

	 *

	 * @param string $output Passed by reference.

	 */

	function end_lvl(&$output, $depth = 0, $args = array())  {

	}



	/**

	 * @see Walker::start_el()

	 * @since 3.0.0

	 *

	 * @param string $output Passed by reference. Used to append additional content.

	 * @param object $item Menu item data object.

	 * @param int $depth Depth of menu item. Used for padding.

	 * @param object $args

	 */

	function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0)  {

		global $_wp_nav_menu_max_depth;

		$item = $object;

		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;



		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';



		ob_start();

		$item_id = esc_attr( sh_set($item, 'ID' ) );

		$removed_args = array(

			'action',

			'customlink-tab',

			'edit-menu-item',

			'menu-item',

			'page-tab',

			'_wpnonce',

		);



		$original_title = '';

		if ( 'taxonomy' == sh_set($item, 'type') ) {

			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );

			if ( is_wp_error( $original_title ) )

				$original_title = false;

		} elseif ( 'post_type' == sh_set($item, 'type') ) {

			$original_object = get_post( $item->object_id );

			$original_title = $original_object->post_title;

		}



		$classes = array(

			'menu-item menu-item-depth-' . $depth,

			'menu-item-' . esc_attr( sh_set( $item, 'object' ) ),

			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),

		);



		$title = sh_set($item, 'title');



		if ( ! empty( $item->_invalid ) ) {

			$classes[] = 'menu-item-invalid';

			/* translators: %s: title of menu item which is invalid */

			$title = sprintf( __( '%s (Invalid)', SH_NAME ), $item->title );

		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {

			$classes[] = 'pending';

			/* translators: %s: title of menu item in draft status */

			$title = sprintf( __('%s (Pending)', SH_NAME ), $item->title );

		}



		$title = empty( $item->label ) ? $title : $item->label;



		?>

		<li id="menu-item-<?php echo $item_id;?>" class="<?php echo implode(' ', $classes);?>">

			<dl class="menu-item-bar">

				<dt class="menu-item-handle">

					<span class="item-title"><?php echo esc_html($title);?></span>

					<span class="item-controls">

						<span class="item-type"><?php echo esc_html($item -> type_label);?></span>

						<span class="item-order hide-if-js">

							<a href="<?php

							echo wp_nonce_url(add_query_arg(array('action' => 'move-up-menu-item', 'menu-item' => $item_id, ), remove_query_arg($removed_args, admin_url('nav-menus.php'))), 'move-menu_item');

							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', SH_NAME);?>">&#8593;</abbr></a>

							|

							<a href="<?php

							echo wp_nonce_url(add_query_arg(array('action' => 'move-down-menu-item', 'menu-item' => $item_id, ), remove_query_arg($removed_args, admin_url('nav-menus.php'))), 'move-menu_item');

							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', SH_NAME);?>">&#8595;</abbr></a>

						</span>

						<a class="item-edit" id="edit-<?php echo $item_id;?>" title="<?php esc_attr_e('Edit Menu Item', SH_NAME);?>" href="<?php

							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : esc_url(add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ));

						?>"><?php _e('Edit Menu Item', SH_NAME);?></a>

					</span>

				</dt>

			</dl>



			<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id;?>">

				<?php if( 'custom' == $item->type ) : ?>

					<p class="field-url description description-wide">

						<label for="edit-menu-item-url-<?php echo $item_id;?>">

							<?php _e('URL', SH_NAME);?><br />

							<input type="text" id="edit-menu-item-url-<?php echo $item_id;?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> url);?>" />

						</label>

					</p>

				<?php endif;?>

				<p class="description description-thin">

					<label for="edit-menu-item-title-<?php echo $item_id;?>">

						<?php _e('Navigation Label', SH_NAME);?><br />

						<input type="text" id="edit-menu-item-title-<?php echo $item_id;?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> title);?>" />

					</label>

				</p>

				<p class="description description-thin">

					<label for="edit-menu-item-attr-title-<?php echo $item_id;?>">

						<?php _e('Title Attribute', SH_NAME);?><br />

						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id;?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> post_excerpt);?>" />

					</label>

				</p>

				<p class="field-link-target description">

					<label for="edit-menu-item-target-<?php echo $item_id;?>">

						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id;?>" value="_blank" name="menu-item-target[<?php echo $item_id;?>]"<?php checked($item -> target, '_blank');?> />

						<?php _e('Open link in a new window/tab', SH_NAME);?>

					</label>

				</p>

				<p class="field-css-classes description description-thin">

					<label for="edit-menu-item-classes-<?php echo $item_id;?>">

						<?php _e('CSS Classes (optional)', SH_NAME);?><br />

						<input type="text" id="edit-menu-item-classes-<?php echo $item_id;?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id;?>]" value="<?php echo esc_attr(implode(' ', $item -> classes));?>" />

					</label>

				</p>

				<p class="field-xfn description description-thin">

					<label for="edit-menu-item-xfn-<?php echo $item_id;?>">

						<?php _e('Link Relationship (XFN)', SH_NAME);?><br />

						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id;?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> xfn);?>" />

					</label>

				</p>

				<p class="field-description description description-wide">

					<label for="edit-menu-item-description-<?php echo $item_id;?>">

						<?php _e('Description', SH_NAME);?><br />

						<textarea id="edit-menu-item-description-<?php echo $item_id;?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id;?>]"><?php echo esc_html($item -> description);

							// textarea_escaped

 ?></textarea>

						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', SH_NAME);?></span>

					</label>

				</p>

				

				<?php do_action('megamenu_menu_item_options', $item_id, $object, $depth, $args = array(), $current_object_id = 0);?>



				<div class="menu-item-actions description-wide submitbox">

					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>

						<p class="link-to-original">

							<?php printf(__('Original: %s', SH_NAME), '<a href="' . esc_attr($item -> url) . '">' . esc_html($original_title) . '</a>');?>

						</p>

					<?php endif;?>

					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id;?>" href="<?php

					echo wp_nonce_url(add_query_arg(array('action' => 'delete-menu-item', 'menu-item' => $item_id, ), remove_query_arg($removed_args, admin_url('nav-menus.php'))), 'delete-menu_item_' . $item_id);

 ?>"><?php _e('Remove', SH_NAME );?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id;?>" href="<?php	echo esc_url(add_query_arg(array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg($removed_args, admin_url('nav-menus.php'))));?>#menu-item-settings-<?php echo $item_id;?>"><?php _e('Cancel', SH_NAME);?></a>				

				</div>



				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id;?>]" value="<?php echo $item_id;?>" />

				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> object_id);?>" />

				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> object);?>" />

				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> menu_item_parent);?>" />

				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> menu_order);?>" />

				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> type);?>" />

			</div><!-- .menu-item-settings-->

			<ul class="menu-item-transport"></ul>

		<?php

		$output .= ob_get_clean();

	}

}