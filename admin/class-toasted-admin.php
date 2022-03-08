<?php

/**
 * The admin-specific functionality of the plugin.
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */
class Toasted_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $toasted    The ID of this plugin.
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
	 * @param      string    $toasted       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $toasted, $version ) {

		$this->toasted = $toasted;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->toasted, plugin_dir_url( __FILE__ ) . 'css/toasted-admin.css', array(), '2.0.4', 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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
		
		wp_enqueue_script( 
			'ajax_script_get_access_token', 
			plugin_dir_url( __FILE__ ) . 'js/toasted-admin.js', 
			array( 'jquery' ), 
			'1.5.20', 
			true );
		
		wp_localize_script( 'ajax_script_get_access_token', 'ajax_script_get_access_token', array(
			'ajax_url' => admin_url( 'admin-ajax.php' )
		));
		wp_localize_script( 'ajax_script_get_access_token', 'ajax_script_sync_func', array(
			'ajax_url' => admin_url( 'admin-ajax.php' )
		));
		
	}

	public function sync_func(){
		die();
	}
		
	public function get_access_token(){
		die();
	}

	// public function product_col_filter_ekshop($columns){
	// 		return array_merge($columns, ['ekshopsync' => __('Ekshop Sync', 'textdomain')]);
	// }
	
	// public function product_custom_col_ekshop($column_key, $post_id) {
	// 	if ($column_key == 'ekshopsync') {
	// 		$values = get_post_custom( $post->ID );
	// 	$check_sync=$values['ekshop_product_sync_status'][0];
	// 		if ($check_sync && $check_sync=='yes') {
	// 			echo '<span style="color:green;" class="dashicons dashicons-yes-alt"></span>';
	// 		} else {
	// 			echo '<a style="color:orange;cursor:pointer" id="eksid-'.$post_id.'" data-ekprodid="'.$post_id.'" class="ekshop-sync-single  dashicons dashicons-update"></a>';
	// 		}
	// 	}
	// }

	// public function ekshop_sync_register_meta_box(){
	// 	add_meta_box( 'ekshop_sync_metabox', __( 'Ekshop Sync Meta', 'textdomain' ), array($this, 'ekshop_sync_metabox_callback'), 'product', 'side', 'high' );
	// }

	// function ekshop_sync_metabox_callback($post){
	// 	//$verified = get_post_meta($post->ID, 'ekshop_product_sync_status', true);
	// 	$values = get_post_custom( get_the_ID() );
	// 	//$values['ekshop_product_sync_status'][0];
	// 	$check_sync=$values['ekshop_product_sync_status'][0];
	// 	if ($check_sync && $check_sync=='yes') {
	// 		echo '<span style="color:green;" class="dashicons dashicons-yes-alt"></span>';
	// 		//var_dump( $values['ekshop_product_sync_status'][0]);
	// 	} else {
	// 		echo '<a style="color:orange;" class="dashicons dashicons-update"></a>';
	// 		//var_dump( $verified);
	// 	}
	// 	//var_dump( $values['ekshop_product_sync_status'][0]);
	// }

// public function ekshop_product_sync_status_save( $post_id ){
//     // Bail if we're doing an auto save
//     if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
//     // if our nonce isn't there, or we can't verify it, bail
//     //if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
//     // if our current user can't edit this post, bail
//     if( !current_user_can( 'edit_post' ) ) return;
     
//     // now we can actually save the data
//     $allowed = array( 
//         'a' => array( // on allow a tags
//             'href' => array() // and those anchors can only have href attribute
//         )
//     );
     
//     // Make sure your data is set before trying to save it
//     // if( isset( $_POST['my_meta_box_text'] ) )
//     //     update_post_meta( $post_id, 'my_meta_box_text', wp_kses( $_POST['my_meta_box_text'], $allowed ) );
         
//     // if( isset( $_POST['my_meta_box_select'] ) )
//     //     update_post_meta( $post_id, 'my_meta_box_select', esc_attr( $_POST['my_meta_box_select'] ) );
         
//     // This is purely my personal preference for saving check-boxes
//     // $chk = isset( $_POST['my_meta_box_check'] ) && $_POST['my_meta_box_select'] ? 'on' : 'off';
//     //update_post_meta( $post_id, 'ekshop_product_sync_status', 'yes' );
// }


// public function cd_meta_box_add()
// {
//     add_meta_box( 'my-meta-box-id', 'Ekshop publish status', array($this, 'cd_meta_box_cb'), 'product', 'side', 'high' );
// }

// function cd_meta_box_cb( $post )
// {
// $values = get_post_custom( $post->ID );
// $text = isset( $values['my_meta_box_text'] ) ? esc_attr( $values['my_meta_box_text'][0] ) : '';
// $selected = isset( $values['my_meta_box_select'] ) ? esc_attr( $values['my_meta_box_select'][0] ) : '';
// $check = isset( $values['my_meta_box_check'] ) ? esc_attr( $values['my_meta_box_check'][0] ) : '';
// // We'll use this nonce field later on when saving.
// wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
//             
// }

// public function cd_meta_box_save( $post_id )
// {
//     // Bail if we're doing an auto save
//     if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
//     // if our nonce isn't there, or we can't verify it, bail
//     if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
//     // if our current user can't edit this post, bail
//     if( !current_user_can( 'edit_post' ) ) return;
     
//     // now we can actually save the data
//     $allowed = array( 
//         'a' => array( // on allow a tags
//             'href' => array() // and those anchors can only have href attribute
//         )
//     );
     
//     // Make sure your data is set before trying to save it
//     if( isset( $_POST['my_meta_box_text'] ) )
//         update_post_meta( $post_id, 'my_meta_box_text', wp_kses( $_POST['my_meta_box_text'], $allowed ) );
         
//     if( isset( $_POST['my_meta_box_select'] ) )
//         update_post_meta( $post_id, 'my_meta_box_select', esc_attr( $_POST['my_meta_box_select'] ) );
         
//     // This is purely my personal preference for saving check-boxes
//     $chk = isset( $_POST['my_meta_box_check'] ) && $_POST['my_meta_box_select'] ? 'on' : 'off';
// 	update_post_meta( $post_id, 'my_meta_box_check', $chk );
// 	update_post_meta( $post_id, 'ekshop_product_sync_status', 'no' );
// }


	public function toasted_admin_menu() {

	    /*
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	     *
	     * Administration Menus: http://codex.wordpress.org/Administration_Menus
	     *
	     */
		//add_menu_page( 'Content Renderer', 'Content Renderer', 'manage_options', 'ekshop_sync_settings', array( $this, 'display_plugin_setup_page' ), plugins_url('images/ekshop-icon-28.png', __FILE__), 59 );
		add_menu_page( 'Toasted', 'Toasted', 'manage_options', 'content-renderer', array( $this, 'display_plugin_setup_page' ), plugins_url('images/favicon-2.png', __FILE__), 59 );
		//add_submenu_page( 'attach_embeds_settings',  __('Setup', 'attach-embeds'), __('Setup', 'attach-embeds'), 'manage_options', 'attach_embeds_settings' );
		//add_submenu_page( 'attach_embeds_settings', 'Reactions Embed', 'Reactions Embed', 'manage_options', 'attach_embeds_reactions', array( $this, 'display_plugin_reactions_page' ) );
		//add_submenu_page( 'attach_embeds_settings', 'Preview Embed', 'Preview Embed', 'manage_options', 'attach_embeds_preview', array( $this, 'display_plugin_preview_page' ) );
	
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_setup_page() {
	    include_once( 'partials/toasted-admin-display.php' );
	}

	// public function display_plugin_reactions_page() {
	//     include_once( 'partials/opcr-reactions-display.php' );
	// }

	// public function display_plugin_preview_page() {
	//     include_once( 'partials/opcr-preview-display.php' );
	// }
	/**
	 * admin init function.
	 *
	 * @access public
	 * @return void
	 */		
	public function toasted_admin_init() {
		register_setting( 'toasted_options', 'toasted_settings', array($this, 'validate_toasted_settings') );
		register_setting( 'toasted_reactions', 'toasted_reactions_settings', array($this, 'validate_toasted_reactions_settings') );
		register_setting( 'toasted_preview', 'toasted_preview_settings', array($this, 'validate_toasted_preview_settings') );
	
		add_settings_section(
			'toasted_settings_section', 
			'', 
			array($this, 'toasted_settings_section_callback'), 
			'toasted_options'
		);
		add_settings_section(
			'toasted_configure_section', 
			'', 
			array($this, 'toasted_configure_section_callback'), 
			'toasted_options'
		);

		add_settings_section(
			'toasted_reactions_section', 
			'', 
			array($this, 'toasted_reactions_section_callback'), 
			'toasted_reactions'
		);

		add_settings_section(
			'toasted_previews_section', 
			'', 
			array($this, 'toasted_previews_section_callback'), 
			'toasted_preview'
		);
		
		add_settings_field( 
			'toasted_api_url', 
			__( 'API endpoint', 'toasted' ), 
			array($this, 'toasted_api_url'), 
			'toasted_options', 
			'toasted_settings_section',
			array('class'=>'toasted-settings-section') 
		);
		
		add_settings_field( 
			'toasted_system_key', 
			__( 'System key', 'toasted' ), 
			array($this, 'toasted_system_key'), 
			'toasted_options', 
			'toasted_settings_section',
			array('class'=>'toasted-settings-section')  
		);

		add_settings_field( 
			'toasted_header_command', 
			__( 'Header command', 'toasted' ), 
			array($this, 'toasted_header_command'), 
			'toasted_options', 
			'toasted_settings_section',
			array('class'=>'toasted-settings-section')
		);

		add_settings_field( 
			'toasted_body_command', 
			__( 'Body command', 'toasted' ), 
			array($this, 'toasted_body_command'), 
			'toasted_options', 
			'toasted_settings_section',
			array('class'=>'toasted-settings-section')
		);

		add_settings_field( 
			'toasted_enable_reaction_posts', 
			__( '', 'toasted' ), 
			array($this, 'toasted_enable_reaction_posts'), 
			'toasted_reactions', 
			'toasted_reactions_section',
			array('class'=>'toasted-reactions-section')
		);

		add_settings_field( 
			'toasted_styles_reaction', 
			__( '', 'toasted' ), 
			array($this, 'toasted_styles_reaction'), 
			'toasted_reactions', 
			'toasted_reactions_section',
			array('class'=>'toasted-reactions-section') 
		);

		add_settings_field( 
			'toasted_enable_preview_posts', 
			__( '', 'toasted' ), 
			array($this, 'toasted_enable_preview_posts'), 
			'toasted_preview', 
			'toasted_previews_section',
			array('class'=>'toasted-previews-section')
		);

		add_settings_field( 
			'toasted_styles_preview', 
			__( '', 'toasted' ), 
			array($this, 'toasted_styles_preview'), 
			'toasted_preview', 
			'toasted_previews_section',
			array('class'=>'toasted-previews-section') 
		);
		
	}	

	public function validate_toasted_settings($input){
		$input['toasted_system_key'] = 	wp_filter_nohtml_kses($input['toasted_system_key']);
		$input['toasted_api_url'] = 	wp_filter_nohtml_kses($input['toasted_api_url']);
		$input['toasted_header_command'] = 	wp_filter_nohtml_kses($input['toasted_header_command']);
		$input['toasted_body_command'] = 	wp_filter_nohtml_kses($input['toasted_body_command']);
		return $input;

	}

	public function validate_opcr_reactions_settings($input){
		$input['opcr_enable_reaction_posts'] = 	wp_filter_nohtml_kses($input['opcr_enable_reaction_posts']);
		$input['opcr_styles_reaction'] = 	wp_filter_nohtml_kses($input['opcr_styles_reaction']);
		update_option('enable_reactions_first_time', 'disable', true);
		return $input;
		
	}
	public function validate_toasted_preview_settings($input){
		$input['toasted_enable_preview_posts'] = 	wp_filter_nohtml_kses($input['toasted_enable_preview_posts']);
		$input['toasted_styles_preview'] = 	wp_filter_nohtml_kses($input['toasted_styles_preview']);
		update_option('enable_preview_first_time', 'disable', true);
		return $input;

	}
	
	/**
	 * toasted_api_url function.
	 *
	 * @access public
	 * @return void
	 */		
	function toasted_api_url(  ) {
		$options = get_option( 'toasted_settings' );
		if ( !isset ( $options['toasted_api_url'] ) )
			$options['toasted_api_url'] = '';
		?>
		<input type='text' size='27' name='toasted_settings[toasted_api_url]' 
        	   value = <?php echo sanitize_text_field($options['toasted_api_url']) ?> >
		<p class="description">Example endpoint: https://demoecommerce.toasted.site/Desktopmodules/dnnrocket/api/rocket/actionremote</p>

		<?php
	} 
	/**
	 * toasted_system_key function.
	 *
	 * @access public
	 * @return void
	 */		
	function toasted_system_key(  ) {
		$options = get_option( 'toasted_settings' );
		if ( !isset ( $options['toasted_system_key'] ) )
			$options['toasted_system_key'] = '';
		?>
		<input type='text' size='27' name='toasted_settings[toasted_system_key]' 
        	   value = <?php echo sanitize_text_field($options['toasted_system_key']) ?> >
		<p class="description">Example system key: rocketecommerce</p>
		<?php
	} 

	function toasted_header_command(  ) {
		$options = get_option( 'toasted_settings' );
		if ( !isset ( $options['toasted_header_command'] ) )
			$options['toasted_header_command'] = '';
		?>
		<input type='text' size='27' name='toasted_settings[toasted_header_command]' 
        	   value = <?php echo sanitize_text_field($options['toasted_header_command']) ?> >	
		<p class="description">Example header command: rocketecommerce_productlistheader</p>
		<?php
	} 
	function toasted_body_command(  ) {
		$options = get_option( 'toasted_settings' );
		if ( !isset ( $options['toasted_body_command'] ) )
			$options['toasted_body_command'] = '';
		?>
		<input type='text' size='27' name='toasted_settings[toasted_body_command]' 
        	   value = <?php echo sanitize_text_field($options['toasted_body_command']) ?> >
		<p class="description">Example body command: rocketecommerce_productlist</p>
		<p class="description">Copy and paste this shortcode in page/post to show body content: <code>[toasted_renderer_body]</code></p>	
		<?php
	}
	/**
	 * toasted_settings_section_callback function.
	 *
	 * @access public
	 * @return void
	 */		
	function toasted_settings_section_callback() { 
		echo '<h1 class="section-title">' . esc_html__('Settings', 'toasted') . '</h1>';
		//echo '<p style="margin-top: 30px;">' . esc_html__('Some text here', 'toasted') . '</p>';
	}

	function toasted_configure_section_callback(){

		$brandingUrl = "#";
		$augmentedRealityUrl = "#";
		$distribution = "#";
	
		echo '<!--<table class="form-table toasted-settings-section" role="presentation"><tbody>
		<tr><th scope="row"></th><td>
		<div class="toasted-two-third">
		<select id="brand-aug-dist">
		<option value="'.$brandingUrl.'">' . esc_html__('Branding','toasted') . '</option>
		<option value="'.$augmentedRealityUrl.'">' . esc_html__('Augmented Reality','toasted') . '</option>
		<option value="'.$distribution.'">' . esc_html__('Distribution','toasted') . '</option>
		</select>	
		</div>
		<div class="toasted-one-third">
		<a id="brand-aug-dist-config" class="button button-default" 
		href="#" target="_blank">' . esc_html__('Configure','toasted') . '</a>
		</div>
		</td></tr></tbody></table>-->';
	}

	function toasted_reactions_section_callback(){
		echo '<h1 class="section-title"> Reactions Embed </h1>
		<p style="margin-top: 30px;">' . esc_html__('The Reactions Embed is enabled for all posts by default. If you wish to control where the embed is placed, disable it here and use the shortcode instead.','toasted') . '</p>';
	}

	function toasted_enable_reaction_posts() {
		$options = get_option( 'toasted_reactions_settings' );
		$options_react = get_option( 'enable_reactions_first_time' );
	
		if($options_react == 'enable'){
			$options['toasted_enable_reaction_posts'] = 'enable';
		}elseif ( !isset ( $options['toasted_enable_reaction_posts'] ) || $options['toasted_enable_reaction_posts'] =='' ){
			$options['toasted_enable_reaction_posts'] = 'disable';
		}else{
			$options['toasted_enable_reaction_posts'] = 'enable';
		}
			
		?>
		<input type="checkbox" class="ios8-switch" id="toasted_light" name='toasted_reactions_settings[toasted_enable_reaction_posts]' value='enable' 
				<?php echo ($options['toasted_enable_reaction_posts'] == 'enable') ? 'checked' : '' ?> > 
				<label for="toasted_light"><b><?php echo __( 'Enable for posts', 'toasted' ) ?></b><br/></label>
		<?php
		
	}

	public function toasted_defaults_trim($trimmed_content){
		$trimmed = trim(preg_replace("/\s+/", "", $trimmed_content));
		$trimmed = str_replace(';',";\n",$trimmed);
		$trimmed = str_replace(':',":",$trimmed);
		return $trimmed;
	}

	function toasted_styles_reaction(){
		$options = get_option( 'toasted_reactions_settings' );
		$reaction_default_css = get_option( 'reaction_default_css' );
		if ( !isset ( $options['toasted_styles_reaction'] ) )
			$options['toasted_styles_reaction'] = '';
			//$options['toasted_styles_reaction'] = trim(preg_replace("/\s+/", "", $options['toasted_styles_reaction']));
			
		?>
		<span class="code-style">&lt;style&gt;</span>
		<span class="code-style">.attach-reactions{</span>
		<textarea class="code-field" rows="6" cols="50" name='opcr_reactions_settings[toasted_styles_reaction]'><?php
		if($options['toasted_styles_reaction'] == ''){
			echo $this->toasted_defaults_trim($reaction_default_css);
		}else{
			$options['toasted_styles_reaction'] = sanitize_text_field($options['toasted_styles_reaction']);
			$g = str_replace(';',";\n",$options['toasted_styles_reaction']);
			echo $this->toasted_defaults_trim($options['toasted_styles_reaction']);
		}
			
		?></textarea>
		<span class="code-style">}</span>	
		<span class="code-style">&lt;&sol;style&gt;</span>
		
			<a style="margin-top:30px;display:inline-block" href="<?php echo esc_url('#')?>" target="_new">
			<?php _e( 'Configure visuals', 'toasted' ) ?>
			</a>
			
		<?php
	}
	function toasted_previews_section_callback(){
		echo '<h1 class="section-title"> Preview Embed </h1>
		<p style="margin-top: 30px;">' . esc_html__('Some text','toasted') . '</p>';
	}

	function toasted_enable_preview_posts() {
		$options = get_option( 'toasted_preview_settings' );
		$options_preview = get_option( 'enable_preview_first_time' );

		if($options_preview == 'enable'){
			$options['toasted_enable_preview_posts'] = 'enable';
		}elseif ( !isset ( $options['toasted_enable_preview_posts'] ) || $options['toasted_enable_preview_posts'] =='' ){
			$options['toasted_enable_preview_posts'] = 'disable';
		}else{
			$options['toasted_enable_preview_posts'] = 'enable';
		}
			
		?>
		<input type="checkbox" class="" id="toasted_light" name='toasted_preview_settings[toasted_enable_preview_posts]' value='enable' 
				<?php echo ($options['toasted_enable_preview_posts'] == 'enable') ? 'checked' : '' ?> > 
				<label for="toasted_light"><b><?php echo __( 'Enable for blog post page', 'toasted' ) ?></b><br/></label>
		<?php
		
	}


	function toasted_styles_preview(){
		$options = get_option( 'toasted_preview_settings' );
		$preview_default_css = get_option( 'preview_default_css' );
		if ( !isset ( $options['toasted_styles_preview'] ) )
			$options['toasted_styles_preview'] = '';
			//$options['toasted_styles_preview'] = trim(preg_replace("/\s+/", "", $options['toasted_styles_preview']));
		?>
		<span class="code-style">&lt;style&gt;</span>
		<span class="code-style">.attach-preview{</span>
		<textarea class="code-field" rows="6" cols="50" name='toasted_preview_settings[toasted_styles_preview]'><?php 
		
		if($options['toasted_styles_preview'] == ''){
			//$style_preview=$preview_default_css;
			echo $this->toasted_defaults_trim($preview_default_css);
		}else{
			
			$options['toasted_styles_preview'] = sanitize_text_field($options['toasted_styles_preview']);
			//$g = str_replace(';',";\n",$options['toasted_styles_preview']);
			echo $this->opcr_defaults_trim($options['toasted_styles_preview']);
		}
		
		?></textarea>
		<span class="code-style">}</span>
		<span class="code-style">&lt;&sol;style&gt;</span>
		
			
			<a style="margin-top:30px;display:inline-block" href="<?php echo esc_url('#')?>" target="_new">
			<?php _e( 'Configure visuals', 'toasted' ) ?>
			</a>
		
		<?php
	}

}