<?php

/**
 * Plugin Name:       Toasted
 * Plugin URI:        
 * Description:       This WordPress plugin renders contents from Toasted E-commerce.
 * Version:           1.0
 * Author:            Nupur
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       toasted
 * Domain Path:       /languages
 * Namespace of plugin: toasted
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'TOASTED_VERSION', '1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-toasted-activator.php
 */

function activate_toasted() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-toasted-activator.php';
	Toasted_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-toasted-deactivator.php
 */
function deactivate_toasted() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-toasted-deactivator.php';
	Toasted_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_toasted' );
register_deactivation_hook( __FILE__, 'deactivate_toasted' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-toasted.php';



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_toasted() {

	$plugin = new Toasted();
	$plugin->run();

}
run_toasted();

