<?php

if( function_exists('bbpress') ) {
//Services
vc_map( array(
			"name" => esc_html__("bbPress Forums", SH_NAME),
			"base" => "bbp-forum-index",
			"class" => "",
			"category" => esc_html__('Jollyall', SH_NAME),
			"icon" => 'faqs' ,
			"params" => array(				
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => esc_html__("Forum", SH_NAME),
				   "param_name" => "forum",
				   "description" => ''
				),
				
			)
	    )
);

}

class WPBakeryShortCode_Sh_Progress_Section extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_Sh_Progress extends WPBakeryShortCode {
}
class WPBakeryShortCode_Sh_Fun_Facts extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_Sh_Fact extends WPBakeryShortCode {
}



function sh_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {

	if($tag=='vc_row' || $tag=='vc_row_inner') {
		$class_string = str_replace('vc_row-fluid', 'row-fluid', $class_string);
	}
	if($tag=='vc_column' || $tag=='vc_column_inner') {
		$class_string = str_replace('vc_span1', 'col-md-1', $class_string);
		$class_string = str_replace('vc_span2', 'col-md-2', $class_string);
		$class_string = str_replace('vc_span3', 'col-md-3', $class_string);
		$class_string = str_replace('vc_span4', 'col-md-4', $class_string);
		$class_string = str_replace('vc_span5', 'col-md-5', $class_string);
		$class_string = str_replace('vc_span6', 'col-md-6', $class_string);
		$class_string = str_replace('vc_span7', 'col-md-7', $class_string);
		$class_string = str_replace('vc_span8', 'col-md-8', $class_string);
		$class_string = str_replace('vc_span9', 'col-md-9', $class_string);
		$class_string = str_replace('vc_span10', 'col-md-10', $class_string);
		$class_string = str_replace('vc_span11', 'col-md-11', $class_string);
		$class_string = str_replace('vc_span12', 'col-md-12', $class_string);
	}
	return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
//add_filter('vc_shortcodes_css_class', 'sh_custom_css_classes_for_vc_row_and_vc_column', 10, 2);

function vc_theme_vc_row($atts, $content = null) {
	
   extract(shortcode_atts(array(
		'el_class'        => '',
		'bg_image'        => '',
		'bg_color'        => '',
		'bg_image_repeat' => '',
		'font_color'      => '',
		'padding'         => '',
		'margin_bottom'   => '',
		'container'		  => '',
		'css'			=> '',
	), $atts));
	
	$atts['base'] = '';
	
	wp_enqueue_style( 'js_composer_front' );
	wp_enqueue_script( 'wpb_composer_front_js' );
	wp_enqueue_style('js_composer_custom_css');
	$vc_row = new WPBakeryShortCode_VC_Row($atts);
	$el_class = $vc_row->getExtraClass($el_class);
	$output = '';
	$css_class =  $el_class;
	
	if( $css ) $css_class .= vc_shortcode_custom_css_class( $css, ' ' ).' ';
	
	$style = $vc_row->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
	
	//$boxed = sh_set( _WSH()->option(), 'boxed_layout' );
	//if( $css_class) exit($css_class);
	if( $container ) return
	 
	'<section class="'.$css_class.'" '.$style.' >
		<div class="container">
			<div class="general-row">
				'.wpb_js_remove_wpautop($content).'
			</div>
		</div>
	<div class="clearfix"></div>
	</section>
	'."\n";  
	
	return 
	'<section class="'.$css_class.' general-row" '.$style.' >
		'.wpb_js_remove_wpautop($content).'
	<div class="clearfix"></div>
	</section>
	'."\n";  
	
}

function vc_theme_vc_row_inner($atts, $content = null) {
	printr($atts);
   extract(shortcode_atts(array(
		'el_class'        => '',
		'container'		  => '',
		'row'			=> '',
	), $atts));
	
	$atts['base'] = '';
	wp_enqueue_style( 'js_composer_front' );
	wp_enqueue_script( 'wpb_composer_front_js' );
	wp_enqueue_style('js_composer_custom_css');


	$output = '';
	$css_class =  $el_class;//apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $vc_row->settings['base']);
	
	if( $container ) return
	 
	'<div class="'.$css_class.'" '.$style.' >
		<div class="container">

				'.wpb_js_remove_wpautop($content).'

		</div>
	</div>'."\n";  
	
 	return 
	'<div class="'.$css_class.' row" >
		'.wpb_js_remove_wpautop($content).'
	</div>'."\n";  
}

function vc_theme_vc_column_inner($atts, $content = null) 
{
	
	extract( shortcode_atts( array( 'width'=> '1/1', 'el_class'=>'' ), $atts ) );
	
	$width = wpb_translateColumnWidthToSpan($width);
	$width = str_replace('vc_col-sm-', 'col-md-', $width);
	$el_class = ($el_class) ? ' '.$el_class : '';
	return 
	'<div class="wpb_column '.$width.$el_class.'">
		'.do_shortcode($content).'
	</div>'."\n";
}

function vc_theme_vc_column($atts, $content = null) 
{
	
	extract( shortcode_atts( array( 'width'=> '1/1', 'el_class'=>'' ), $atts ) );
	
	$width = wpb_translateColumnWidthToSpan($width);
	$width = str_replace('vc_col-sm-', 'col-md-', $width);
	$el_class = ($el_class) ? ' '.$el_class : '';
	return 
	'<div class="wpb_column '.$width.$el_class.'">
		'.do_shortcode($content).'
	</div>'."\n";
}


$param = array(
  "type" => "checkbox",
  "holder" => "div",
  "class" => "",
  "heading" => esc_html__("Container", SH_NAME),
  "param_name" => "container",
  "value" => array('Center Page'=>true),
  "description" => esc_html__("Choose whether you want to add a container before row or not.", SH_NAME)
);


vc_add_param('vc_row', $param);
vc_add_param('vc_row_inner', $param);


