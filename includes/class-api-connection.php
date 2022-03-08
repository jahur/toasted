<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Toasted
 * @subpackage toasted/includes
 */
class Api_Connection {

    //string
	public $base_url;

	//array
	public $param;

    public function __construct(){
        $this->base_url = "https://demoecommerce.toasted.site/Desktopmodules/dnnrocket/api/rocket/actionremote";
		$this->param = array(
			'cmd' 		=> 'rocketecommerce_productlistheader',
			'systemkey' => 'rocketecommerce',
			'language' 	=> 'en-US'
		);
        
    }
	/**
	 *
	 * Adds two option values into  database to enable Reactions and Preview show frontend first time.  
	 * Checked two checkboxes (Enable for Posts and Enable for Blog Post Page)
	 * 
	 * @since    1.0.0
	 */
	public function get_contents_to_render($base_url, $param) {

        $base_url = !empty($base_url) ? $base_url : $this->base_url;
		$param = is_array($param) ? $param : $this->param;
		

        $url = $base_url."?cmd=".$param['cmd']."&systemkey=".$param['systemkey']."&language=".$param['language'];
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
		"Content-Type: application/xml",
		"Accept: application/xml",
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

	    $data = '';
		$data .= '<items>';
		$data .= '<item>';
		$data .= '<itemid>0</itemid>';
		$data .= '<portalid>0</portalid>';
		$data .= '<moduleid>0</moduleid>';
		$data .= '<xrefitemid>0</xrefitemid>';
		$data .= '<parentitemid>0</parentitemid>';
		$data .= '<typecode>paramInfo</typecode>';
		$data .= '<guidkey/>';
		$data .= '<lang>en-US</lang>';
		$data .= '<userid>0</userid>';
		$data .= '<sortorder>0</sortorder>';
		$data .= '<genxml>';
		$data .= '<settings>';
		$data .= '<language><![CDATA[en-US]]></language>';
		$data .= '<remoteparams><![CDATA[wAIAAB+LCAAAAAAABACNUttKAzEQ/RY/wMZnCQtFH1QQLFb6UIosybiNzWWZzLbdv3ea2E2qCL4kZ86cMzO5SEPgGnlajW5upPhGsg9Irc3chKULerCQ2QnLI8JHqVBFsm8RPJXcRSxp7EEFDY0UBXaD0TsYmZuQbX3XgL9+e5UiYTlEwFzxG8nIMwbUgCeyBLIDf3SW80BkfBcZjZH7p8JX67v7+XK+xqB2QDyAc4AKNhvuXskQXCDOu962BMW2N3CYqbglZ5Plpw58ZzwMaItlS9THWyE0S6d+MwotN9OzyDeTKlXOCGpAQ+PFwJ8varUyj8+70W7D08NhsVzM89S1mv0XLg6S6MznvVVk9tWpljhAJTun8+H+eXm/xJlQTv/pe++RP5QiayJVNZJFlNcT5wdNP7X5AixXSgbAAgAA]]></remoteparams>';
		$data .= '</settings>';
		$data .= '<urlparams>';
		$data .= '<TabId><![CDATA[267]]></TabId>';
		$data .= '<language><![CDATA[en-US]]></language>';
		$data .= '</urlparams>';
		$data .= '</genxml>';
		$data .= '</item>';
		$data .= '</items>';
		
		
		
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

	
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$resp = curl_exec($curl);
		curl_close($curl);

		return $resp;
		
	}

}