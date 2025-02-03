<?php
/**
 * Development Suite bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin. (credit: WordPress Plugin Boilerplate)
 *
 * @link              https://ikehunter.com
 * @since             0.1.0
 * @package           Cobolt
 *
 * @wordpress-plugin
 * Plugin Name:       Cobolt Suite
 * Plugin URI:        https://coboltsuite.com/
 * Description:       Provides a suite of tools to aid and enhance WordPress development.
 * Version:           0.1.0 (Beta)
 * Author:            IkeHunter Web Development
 * Author URI:        https://ikehunter.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cobolt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'COBOLT_VERSION', '1.0.0' );
define( 'COBOLT_PLUGIN_NAME', 'Development Suite for WordPress' );
define( 'COBOLT_PLUGIN_SLUG', 'cobolt' );
define( 'COBOLT_DIR', plugin_dir_path( __FILE__ ) );


/**
 * The code that runs during plugin activation.
 */
function activate_cobolt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/cobolt-activator.php';
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_cobolt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/cobolt-deactivator.php';
}

register_activation_hook( __FILE__, 'activate_cobolt' );
register_deactivation_hook( __FILE__, 'deactivate_cobolt' );

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_cobolt() {
	require COBOLT_DIR . './includes/cobolt.php';
}

run_cobolt();