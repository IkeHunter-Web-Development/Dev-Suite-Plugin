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
 * @package           Dev_Suite
 *
 * @wordpress-plugin
 * Plugin Name:       Development Suite for WordPress
 * Plugin URI:        https://ikehunter.com/dev-suite
 * Description:       Provides a suite of tools to aid and enhance WordPress development.
 * Version:           0.1.0 (Beta)
 * Author:            IkeHunter Web Development
 * Author URI:        https://ikehunter.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dev-suite
 * Domain Path:       /languages
 */

 // If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DEV_SUITE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_dev_suite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-activator.php';
	Dev_Suite_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_dev_suite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-deactivator.php';
	Dev_Suite_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dev_suite' );
register_deactivation_hook( __FILE__, 'deactivate_dev_suite' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dev-suite.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dev_suite() {

	$plugin = new Dev_Suite();
	$plugin->run();

}
run_dev_suite();
