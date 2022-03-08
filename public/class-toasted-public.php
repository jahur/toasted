<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 * @package    Toasted
 * @subpackage toasted/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 * @since      1.0.0
 * @package    Toasted
 * @subpackage toasted/public

 */

class Toasted_Public {
	/**

	 * The ID of this plugin.

	 *

	 * @since    1.0.0

	 * @access   private

	 * @var      string    $plugin_name    The ID of this plugin.

	 */

	private $toasted;



	/**

	 * The version of this plugin.

	 *

	 * @since    1.0.0

	 * @access   private

	 * @var      string    $version    The current version of this plugin.

	 */

	private $version;



	/**

	 * Initialize the class and set its properties.

	 *

	 * @since    1.0.0

	 * @param      string    $plugin_name       The name of the plugin.

	 * @param      string    $version    The version of this plugin.

	 */

	public function __construct( $plugin_name, $version ) {



		$this->toasted = $plugin_name;

		$this->version = $version;



	}



	/**

	 * Register the stylesheets for the public-facing side of the site.

	 *

	 * @since    1.0.0

	 */

	public function enqueue_styles() {



		/**

		 * This function is provided for demonstration purposes only.

		 *

		 * An instance of this class should be passed to the run() function

		 * defined in Plugin_Name_Loader as all of the hooks are defined

		 * in that particular class.

		 *

		 * The Plugin_Name_Loader will then create the relationship

		 * between the defined hooks and the functions defined in this

		 * class.

		 */

		wp_enqueue_style( $this->toasted, plugin_dir_url( __FILE__ ) . 'css/toasted-public.css', array(), $this->version, 'all' );

	}



	/**

	 * Register the JavaScript for the public-facing side of the site.

	 *

	 * @since    1.0.0

	 */

	public function enqueue_scripts() {

		/**

		 * This function is provided for demonstration purposes only.

		 *

		 * An instance of this class should be passed to the run() function

		 * defined in Plugin_Name_Loader as all of the hooks are defined

		 * in that particular class.

		 *

		 * The Plugin_Name_Loader will then create the relationship

		 * between the defined hooks and the functions defined in this

		 * class.

		 */

		wp_enqueue_script( $this->toasted, plugin_dir_url( __FILE__ ) . 'js/toasted-public.js', array( 'jquery' ), $this->version, false );

	}



	/**

	 * add meta property function.

	 *

	 * @access public

	 * @return void

	 */

	// public function opcr_add_meta_property() {

	// 	$options = get_option( 'opcr_settings' );
	// 	$options['opcr_text_evaluation_key'] = sanitize_text_field($options['opcr_text_evaluation_key']);
	// 	$options['opcr_text_domain_verification_code'] = sanitize_text_field($options['opcr_text_domain_verification_code']);

	// 	$eval_key = '';

	// 	if ( isset ( $options['opcr_text_evaluation_key'] ) ){

	// 		$eval_key = $options['opcr_text_evaluation_key'];

	// 	}

	// 	if ( isset ( $options['opcr_text_domain_verification_code'] ) ){

	// 		$verification_code = $options['opcr_text_domain_verification_code'];

	// 	}



	// 		$metatag = '<meta property="attach:site-verification" content="" />';

	// 		$metatag .= '<script src="https://embeds.attach.live/v1" defer></script>';

	// 		$metatag .= '<meta property="attach:evaluation-key" content="'.$eval_key.'">';

	// 		$metatag .= '<meta property="attach:site-verification" content="'.$verification_code.'" />';

	// 		echo $metatag;

	// 	}

		

	public function toasted_show_reactions( $content ) {

		$options = get_option( 'toasted_reactions_settings' );
		$options_react = get_option( 'enable_reactions_first_time' );
		$options_react_default = get_option( 'reaction_default_css' );
		
        $options['toasted_styles_reaction'] = sanitize_text_field($options['toasted_styles_reaction']);
				

		if ( is_single() && in_the_loop() && is_main_query() && ( $options_react == 'enable' ||	$options['opcr_enable_reaction_posts'] == 'enable' ) ) {

            global $post; $id = $post->ID; $permalink = get_permalink($id);
	        
			$reactions_content = $content;

			$reactions_content .= '<div class="opcr-reactions" data-property-item="'.$permalink.'"></div>';

	        $reactions_content .= '<style>.opcr-reactions{';

    	        if ( isset ( $options['opcr_styles_reaction'] ) && $options['opcr_styles_reaction'] != ''){

    	            $reactions_content .= $options['opcr_styles_reaction']; 

					}
					else{

    	            $reactions_content .= $options_react_default;

    	           }  

	        $reactions_content .= '}</style>';

    

			return $reactions_content;

	    }else{
	        return $content;
	        }

		}



public function toasted_show_previews( $content ) {
    
    $options = get_option( 'toasted_preview_settings' );
	$options_preview = get_option( 'enable_preview_first_time' );
	$options_preview_default = get_option( 'preview_default_css' );
	$options['toasted_styles_preview'] = sanitize_text_field($options['toasted_styles_preview']);

    if ( (!is_single()) && (get_post_type() == 'post') && in_the_loop() && is_main_query() && ( $options_preview == 'enable' || $options['toasted_enable_preview_posts'] == 'enable')) {

        global $post; $id= $post->ID; $permalink = get_permalink($id); $has_run = true;
        if($has_run){
        $preview_content = $content;
		$preview_content .= '<div class="toasted-preview" data-property-item="'.$permalink.'"></div>';
	    $preview_content .= '<style>.toasted-preview{';
    	        if ( isset ( $options['toasted_styles_preview'] ) and $options['toasted_styles_preview'] != ''){

    	            $preview_content .= $options['toasted_styles_preview']; 

				     }
				else{

    	            $preview_content .= $options_preview_default;

    	           }  
	    $preview_content .= '}</style>';
        
        
		return $preview_content;
        }
	    $has_run = false;

		}else{
		    return $content;
		    }

    }

    
// toasted_renderer_header_script

public function toasted_renderer_header_script(){

	$header_script_api = new Api_Connection();

	$options = get_option( 'toasted_settings' );
	$base_url = sanitize_text_field($options['toasted_api_url']);
	$cmd = sanitize_text_field($options['toasted_header_command']);
	$systemkey = sanitize_text_field($options['toasted_system_key']);
	//$base_url = "https://demoecommerce.toasted.site/Desktopmodules/dnnrocket/api/rocket/actionremote?cmd=rocketecommerce_productlistheader&language=en-US";
	//$base_url= "https://demo.openstore-ecommerce.com/apitest2.ashx";
	//$cmd = "getheader";
	$param = array(
		'cmd' 		=> $cmd,
		'systemkey' => $systemkey,
		'language' 	=> 'en-US'
	);
	echo $header_script_api->get_contents_to_render($base_url, $param);

}


// Shortcode initialize
public function toasted_shortcodes(){

    add_shortcode('toasted_renderer_body', array($this, 'toasted_shortcode_function'));

    }

    
public function toasted_shortcode_function($atts){

    ob_start();

	$body_html_api = new Api_Connection();
	$options = get_option( 'toasted_settings' );
	$base_url = sanitize_text_field($options['toasted_api_url']);
	$cmd = sanitize_text_field($options['toasted_body_command']);
	$systemkey = sanitize_text_field($options['toasted_system_key']);
	$param = array(
		'cmd' 		=> $cmd,
		'systemkey' => $systemkey,
		'language' 	=> 'en-US'
	);

	echo $body_html_api->get_contents_to_render($base_url, $param);
	//var_dump($c);
	/*
	$data = array(
            "paramxml" => "<genxml>TEST</genxml>"
        );
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url."?cmd=".$cmd,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => $data,
			CURLOPT_SSL_CIPHER_LIST => 'DEFAULT@SECLEVEL=1'
        ));
        
        $response = curl_exec($curl);
        //echo $response;
        curl_close($curl); */
	
	//$respon = file_get_contents($base_url."?cmd=".$cmd);
	//var_dump($respon);
// 	$ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, $base_url."?cmd=".$cmd);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POST, 0);
//curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT@SECLEVEL=1');

//$headers = array();
//$headers[] = 'Content-Type: application/json';
//$headers[] = 'Authorization: Bearer b7d03a6947b217efb6f3ec3bd3504582';
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// 	var_dump($result);
// curl_close($ch);

	return ob_get_clean();

    }

}

