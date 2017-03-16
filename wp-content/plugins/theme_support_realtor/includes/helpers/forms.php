<?php

class SH_Forms
{
	private $_hash;
	
	function __construct()
	{
		$this->_hash = uniqid( 'form_builder_' );
		
		$this->_old_hash = sh_set( $_COOKIE, 'sh_form_builder_hash' );
		
		setcookie( 'sh_form_builder_hash', $this->_hash );
		
		add_shortcode( 'sh_form', array( $this, 'form' ) );
	}
	
	function form( $atts, $content = null )
	{
		extract( shortcode_atts( array(
			'id' => '',
		), $atts ) );
		
		if( !$id ) return;
		
		$this->loops = array('select', 'checkbox', 'radio');
		$this->labels = array('select'=>'dropdown', 'checkbox'=>'check', 'radio'=>'radio');
		
		$this->build( $id );
		
	}
	
	private function build( $id )
	{
		$this->meta = get_post_meta( $id, 'sh_form_settings', true );
		$this->id = $id;
		$fields = get_post_meta( $id, 'sh_forms_option', true );

		
		if( !$fields ) return;
		
		$this->fields = sh_set( $fields, 'field' );
		
		echo $this->post();
		
		do_action( 'sh_form_before_form' );
		
		echo form_open( sh_set( $this->meta, 'form_action' ), 'method="'.sh_set( $this->meta, 'form_method', 'post' ).'"' );
		
		foreach( $this->fields as $i => $field )
		{
			//if( $field['type'] != 'select' ) continue;
			
			$this->type = $this->type( sh_set( $field, 'type' ) );
			
			$this->build_field( $field );
		}
		
		echo '<input type="hidden" name="form_secret" value="'.$this->_hash.'" />';
		echo '<div class="pull-right">'.form_submit( array('class'=>'button small'), __('Send', SH_NAME) ).'</div>';
		
		echo form_close();
		
		do_action( 'sh_form_after_form' );

	}
	
	function build_field( $field, $label = true, $settings = array() )
	{
		
		//$default = array('name', 'type','settings','class','default','placeholder','id'=>'');
		
		$fiel = $this->parse_field( $field );
		extract( $fiel );
		
		$class = ( isset( $class ) && $class ) ? 'form-control '.$class : 'form-control';
		 
		if( $label && !$placeholder )
		{
			do_action( 'sh_form_before_label', $field );
			
			echo form_label( $placeholder, $name );
			
			do_action ( 'sh_form_after_label', $field );
		}
		
		if( $placeholder )
		{
			$settings['attrs']['placeholder'] = $placeholder;
		}
		
		$settings['attrs']['class'] = $class;
		
		$default = sh_set( $settings, $name ) ? sh_set( $settings, $name ) : $default;
		
		switch($this->type)
		{
			case "input":
				$html['element'] = form_input(array_merge(array('name'=>$name, 'type' => $type, 'value'=>'','id'=>$id), (array) $settings['attrs']));
			break;
						
			case "dropdown":
				$settings['attrs'] = _parse_form_attributes('', array_merge((array) $settings['attrs'], array('id'=>$name)));
				$html['element'] = form_dropdown($name, $options , _WSH()->validation->set_value($name, $default), $settings['attrs']);
			break;
			
			case "multiselect":
				$size = (count($settings['value']) < 10) ? count($settings['value']) * 20 : 220;
				$settings['attrs'] = array_to_string(array_merge((array) $settings['attrs'], array('id'=>$field, 'style'=>"height:".$size."px;")));
				$html['element'] = form_multiselect($field.'[]', $settings['value'], _WSH()->validation->set_value($name, $default_value), $settings['attrs'] );
			break;
			
			case "textarea":
				$settingsvalue = empty($user_settings[$name]) ? sh_set($settings, 'value') : $user_settings[$name];
				$html['element'] = form_textarea(array_merge(array('name'=>$name,'value'=>_WSH()->validation->set_value($name, $settingsvalue),'id'=>$name), (array) $settings['attrs']));
			break;
			
			
			case "switch" : 
				$html['element'] = '';
				
				$checked = (sh_set($user_settings, $field) == 'on') ? 'checked="checked"' : '';
				$html['element'] = '<span class="form_style switch"><input type="checkbox" name="'.$field.'" '.$checked.'></span>';

				
			break;
			case 'file':
				$html['element'] = '<span class="file_upload">';
				$html['element'] .= form_input(array_merge(array('name'=>$field,'value'=>$default_value,'id'=>$field), (array) $settings['attrs'])).
									'<input type="file" onchange="this.form.'.$field.'.value = this.value" class="fileUpload" name="'.$field.'_file" id="fileUpload">
									<em>'.__('UPLOAD', THEME_NAME).'</em>';
				$html['element'] .= '</span>';
				$html['preview'] = '';
				if(sh_set($user_settings, $field)) $html['preview'] = sh_set($user_settings, $field);
			break;
			
			case "checkbox":
			case "radio":
				$html['element'] = '<div class="clearfix">';
				foreach($settings['value'] as $key=>$val):
					$html['element'] .= form_radio($field, $key, ($default_value == $key) ? true : '',$settings['attrs']).'<label class="'.$settings['type'].' cont-lable" for="'.$field.'"> '.$val.'</label>'.				
									'';
				endforeach;
			$html['element'] .= '</div>';
			break;
			
			case "colorbox":
				$html['element'] = form_input(array_merge(array('name'=>$field,'value'=>$default_value,'id'=>$field, 'class'=>'nuke-color-field'), (array) $settings['attrs']));
			break;
			
			case "timepicker":
				$html['element'] = form_input(array_merge(array('name'=>$field,'value'=>$default_value,'id'=>$field), (array) $settings['attrs']));
			break;
			
			case "hidden":
				$html['label'] = '';
				$html['element'] = form_input(array_merge(array('type'=>'hidden','name'=>$field,'value'=>$default_value,'id'=>$field), sh_set($settings, 'attrs')));
			break;	
					
		}
		
		do_action( 'sh_form_before_field', $fiel );
		
		echo $html['element'];
		
		do_action( 'sh_form_after_field', $fiel );
	}
	
	/**
	 * return the array to generate form field
	 *
	 */
	private function parse_field( $field )
	{
		$default = array('name', 'type','settings','class','default','placeholder','id');
		
		$new = array();
		
		foreach( $default as $d )
		{
			$new[$d] = sh_set( $field, $d );
		}
		
		$new = $this->options( $new, $field );
		
		return $new;
	}
	
	/**
	 * return options array for select, checkbox and radio button
	 *
	 */
	private function options( $new = array(), $field )
	{
		$type = $new['type'];
		$loop = sh_set( $field, $type.'_value');
		
		if( in_array( $type, $this->loops ) ){
			
			$label = sh_set( $this->labels, $type );
			
			foreach( $loop as $l ){
				$new['options'][sh_set($l, $label.'_value')] = sh_set($l, $label.'_label');
			}
		}
		
		return $new;
	}
	
	private function type( $type )
	{
		$array = array(
		
			'text' => 'input',
			'email' => 'input',
			'url'	  => 'input',
			'select'   => 'dropdown'
		);
		
		return sh_set( $array, $type, $type );
	}
	
	function post()
	{
		
		_load_class( 'validation', 'helpers', true );
		$t = _WSH();
		

		$settings = $t->option();
		
		$message = '';
			
		foreach( $this->fields as $f )
		{
			$field_name = sh_set( $f, 'name' );
			$validation = array();
			
			$placehold = sh_set( $f, 'placeholder' );
			
			foreach( sh_set( $f, 'validation' ) as $valid ) $validation[] = $valid;
			
			/** set validation rules for contact form */
			$t->validation->set_rules( $field_name ,'<strong>'.sh_set( $f, 'placeholder' ).'</strong>', implode( '|', $validation ) );
			
			$message .= "$placehold\t".$t->validation->post($field_name)."\r\n";
		}
		
		if( sh_set( $_POST, 'form_secret' ) !== $this->_old_hash ) 
		$t->validation->_error_array['form_secret'] = __('There is form validation error or spamming issue', SH_NAME);
		
		
		if($t->validation->run() !== FALSE && empty($t->validation->_error_array))
		{
			
			$contact_to = (sh_set( $this->meta, 'form_email')) ? sh_set( $this->meta, 'form_email') : get_option('admin_email');
	
			$headers = 'From: '.get_option('name').' <'.get_option('admin_email').'>' . "\r\n";
			wp_mail($contact_to, sprintf(__('%s - Form Submitted', SH_NAME), get_the_title($this->id) ), $message, $headers);
	
			$response = sh_set($this->meta, 'form_success_msg') ? $this->meta['form_success_msg'] : sprintf( __('Form is successfully submitted, we\'ll response you shortly.',SH_NAME), $name);

			return "<div id='success_page' class=\"alert-success\">".
						"<h1>".__("Successful", SH_NAME)."</h1>".
						"<p>".$response."</p>".
					"</div>";

			
		
		}else
		{
			 $messages = '';
			 
			 if( is_array( $t->validation->_error_array ) )
			 {

				 foreach( $t->validation->_error_array as $msg )
				 {
					 $messages .= '<div class="alert">
					 				<div class="error_message alert-error">
										<p>'.__('Error! ', SH_NAME).$msg.'</p>
									</div>
								</div>';
				 }
			}
			
			return $messages;
	
		}
	
		return '';
		
	}
}
