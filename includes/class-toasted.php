<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 */
class Toasted {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Toasted_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $attach_embeds    The string used to uniquely identify this plugin.
	 */
	protected $toasted;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'TOASTED_VERSION' ) ) {
			$this->version = TOASTED_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->toasted = 'toasted';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
	 * - Plugin_Name_i18n. Defines internationalization functionality.
	 * - Plugin_Name_Admin. Defines all hooks for the admin area.
	 * - Plugin_Name_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-toasted-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-toasted-i18n.php';
		

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-api-connection.php';
		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-toasted-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-toasted-public.php';

		$this->loader = new Toasted_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Attach_Embeds_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Toasted_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Toasted_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		/**
		 * Adding admin menu in main WordPress menu.
		 */
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'toasted_admin_menu' );

		/**
		 * Registering all plugin settings and options.
		 */
		$this->loader->add_action( 'admin_init', $plugin_admin, 'toasted_admin_init' );
		
		$this->loader->add_action( 'wp_ajax_get_access_token', $plugin_admin, 'get_access_token' );

		$this->loader->add_action( 'wp_ajax_sync_func', $plugin_admin, 'sync_func' );

		//$this->loader->add_filter('manage_product_posts_columns', $plugin_admin, 'product_col_filter_ekshop');
		 
		//$this->loader->add_action('manage_product_posts_custom_column', $plugin_admin, 'product_custom_col_ekshop', 10, 2);

		//$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'ekshop_sync_register_meta_box' );
		//ekshop_product_sync_status_save
		//$this->loader->add_action( 'save_post', $plugin_admin, 'ekshop_product_sync_status_save' );



		//custom new

		//$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'cd_meta_box_add' );
		//$this->loader->add_action( 'save_post', $plugin_admin, 'cd_meta_box_save' );

		

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Toasted_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'wp_head', $plugin_public, 'toasted_renderer_header_script' );
		
		$this->loader->add_action( 'init', $plugin_public, 'toasted_shortcodes' );

		//$this->loader->add_action( 'wp_head', $plugin_public, 'opcr_add_meta_property' );
		
		//$this->loader->add_filter( 'the_content', $plugin_public, 'opcr_show_reactions' );
		
		//$this->loader->add_filter( 'the_title', $plugin_public, 'opcr_show_previews' );
		
		//$this->loader->add_action( 'init', $plugin_public, 'opcr_show_reactions' );
			
		//$this->loader->add_filter( 'the_content', $plugin_public, 'opcr_show_previews' );
		
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->toasted;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Toasted_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
