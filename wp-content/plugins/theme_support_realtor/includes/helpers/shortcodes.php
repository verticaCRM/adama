<?php







class SH_Shortcodes



{



	public $keys;



	protected $base = '';



	protected $_dir = '';



	protected $_s_dir = '';



	



	



	function __construct()



	{



		//add_action('init', array( $this, 'add' ) );
		$this->add();


		



		$this->_dir = get_template_directory();



		$this->_s_dir = get_stylesheet_directory();



		







	}



	



	function add()



	{







		$this->keys = include( SH_TH_ROOT.'includes/resource/shortcodes.php');



		//$this->keys = _WSH()->keys;



		



		foreach( $this->keys as $k )



		{



			//printr($k);



			$this->base = sh_set( $k, 'base' );



			$base = $this->base;



			$this->$base = create_function( 



											'$atts, $contents = null, $base, $current', 



											'$output = _WSH()->shortcodes->shortcode_output( $atts, $contents, $base, $current);



											 return $output;'



										   );



			$this->current_atts = $k;	







			add_shortcode( $this->base, array( $this, $this->base ) );



			



			if( function_exists( 'vc_map' ) ) {vc_map( $k );}



		}



		



	}



	



	function shortcode_output( $atts, $contents = null, $base, $current = array() )



	{



		



		if( !$current ) return;



		$current = sh_set( $this->keys, $base );







		extract( shortcode_atts( $this->create_atts($current), $atts ) );







		$file = 'includes/modules/shortcodes/'.str_replace('sh_', '', $base).'.php';







		$output = include( _WSH()->includes( $file ) );



		return $output;



		



		



		//if( file_exists( $this->_s_dir.$file ) ) include( $this->_s_dir.$file );



		//else include( $this->_dir.$file );



	}



	



	/** method automatically call when php search for methods */



	



	public function __call($method, $args)



	{



	   if(property_exists($this, $method)) {



		   if(is_callable($this->$method)) {



			   $args[] = $this->current_atts;



			   return call_user_func_array($this->$method, $args);



		   }



	   }



	}



	



	function create_atts( $array = array() )



	{



		//$contents = '';



		$atts = array();



		



		foreach( $array['params'] as $arr ){



			if( $arr['param_name'] == 'content' ) continue;



			



			$atts[$arr['param_name']] = sh_set( $arr, 'default' ) ? sh_set( $arr, 'default' ) : ''; 



		}



		



		return $atts;



	}



	



	



	function excerpt( $str, $len = 35 )



	{



		return sh_trim( $str , $len );



	}







	



}



?>