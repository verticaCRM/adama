<?php 

class SH_Meta_boxes
{
	
	var $_fields = '';
	
	
	function __construct()
	{
		include(get_template_directory().'/includes/resource/awesom_icons.php');
		$GLOBALS['_font_awesome'] = $awesome_icons;
		
		add_action( 'admin_init', array( $this, 'add_metabox' ) );
		
		add_action( 'save_post', array( $this, 'publish_post' ) );
		
		
	}
	
	
	function add_metabox()
	{
		
		include(get_template_directory().'/includes/resource/settings.php');
		$this->_fields = $settings;
		$keys = array_keys( $this->_fields );
		//printr($keys);
		foreach( $keys as $k ){
			add_meta_box($k.'_settings', sprintf(__( '%s Settings', SH_NAME ), ucwords(str_replace( 'bistro_', '', $k ))), array( $this, 'inner_custom_box'), $k );			
		}
	}
	
	function inner_custom_box($post)
	{
		wp_enqueue_style(array('jquery-ui-datepicker-custom', 'admin-custom-styles'));
		wp_enqueue_script(array('jquery-ui-datepicker', 'jquery-select2'));
		$t = &$GLOBALS['_sh_base'];
		$post_type = sh_set( $post, 'post_type');
		$settings = get_post_meta( sh_set($post, 'ID' ), '_bistro_'.$post_type.'_settings', true);
		
		//$fields = $t->_fields_enqueue(sh_set($this->_fields, $post_type), $settings); 
		//printr($fields);
		$fields = sh_set( $this->_fields, $post_type );
		//printr($fields);
		$nph = new NHP_Options;
		$nph->args['opt_name'] = $post_type;
		//printr($nph);
		if( $fields && is_array( $fields ) ): ?>
        	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.fields_set select').select2();
				if( $('#start_date') ){
					$('#start_date, #end_date').datepicker();
				}
			});
			</script>

			<?php foreach( $fields as $f):
				?>
				
                <div class="fields_set" >
                	<label><strong><?php echo sh_set( $f, 'title'); ?></strong></label>
                    <div class="field">
                    	<?php echo $nph->_field_input($f, sh_set($settings, sh_set( $f, 'id' )) ); 	?>
                    </div>
                </div>
            <?php endforeach;
		endif;
	}
	
	
	function _html()
	{
	}
	
	function publish_post($post_id)
	{
		global $post;
		$post_type = sh_set( $_POST, 'post_type' );
		$setting = sh_set($this->_fields, $post_type);
		
		$types = array_merge(array('post', 'page'), array_keys( $this->_fields )); 
		if( !in_array($post_type , $types) ) return;
		
		$data = sh_set( $_POST, $post_type);//array_intersect_key( $_POST, $setting);
		if( !$data ) return;
		//printr($post);
		if( $post_type == 'bistro_deal') update_post_meta( $post_id, '_bistro_bistro_deal_date', strtotime(sh_set( $data, 'end_date')));
		update_post_meta( $post_id, '_bistro_'.$post_type.'_settings', $data );
	}
}


