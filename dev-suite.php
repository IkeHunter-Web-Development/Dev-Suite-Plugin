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

define( 'DEV_SUITE_VERSION', '1.0.0' );
define( 'DEV_SUITE_PLUGIN_NAME', 'Development Suite for WordPress' );
define( 'DEV_SUITE_PLUGIN_SLUG', 'dev-suite' );
define( 'DEV_SUITE_DIR', plugin_dir_path( __FILE__ ) );

// TODO: Add update checker
// https://github.com/YahnisElsts/plugin-update-checker?tab=readme-ov-file

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/dev-suite-activator.php
 */
function activate_dev_suite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/dev-suite-activator.php';
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/dev-suite-deactivator.php
 */
function deactivate_dev_suite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/dev-suite-deactivator.php';
}

register_activation_hook( __FILE__, 'activate_dev_suite' );
register_deactivation_hook( __FILE__, 'deactivate_dev_suite' );

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_dev_suite() {
	require DEV_SUITE_DIR . './includes/dev-suite.php';
}

run_dev_suite();


function test_notice_1() {
	?>
    <div class="notice notice-error">
        <h2>Test Notice 1</h2>
        <p>This is a test notice.</p>
    </div>
	<?php
}

function test_notice_2() {
	?>
    <div class="notice notice-success is-dismissible">
        <h2>Test Notice 2</h2>
        <p>This is a test notice.</p>
    </div>
	<?php
}

function test_notice_3() {
	?>
    <div class="notice notice-warning is-dismissible">
        <h2>Test Notice 3</h2>
        <p>This is a test notice.</p>
    </div>
	<?php
}

function test_notice_4() {
	?>
    <div class="notice notice-info is-dismissible">
        <h2>Test Notice 4</h2>
        <p>This is a test notice.</p>
    </div>
	<?php
}

add_action( 'admin_notices', 'test_notice_1' );
add_action( 'admin_notices', 'test_notice_2' );
add_action( 'admin_notices', 'test_notice_3' );
add_action( 'admin_notices', 'test_notice_4' );



