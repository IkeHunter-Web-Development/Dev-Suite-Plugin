<?php

namespace Cobolt\Admin;
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Cobolt
 * @subpackage Cobolt/admin
 */
require_once plugin_dir_path( __FILE__ ) . 'admin-notices.php';
require_once plugin_dir_path( __FILE__ ) . 'admin-dashboard-widgets.php';

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cobolt
 * @subpackage Cobolt/admin
 * @author     Your Name <email@example.com>
 */
class Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $Cobolt The ID of this plugin.
	 */
	private $Cobolt;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Admin notices.
	 *
	 * @since 1.0.0
	 */
	private $admin_notices;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $Cobolt The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( string $Cobolt, string $version ) {

		$this->Cobolt = $Cobolt;
		$this->version   = $version;

		$this->admin_notices     = new Cobolt_Admin_Notices( $Cobolt );
		$this->dashboard_widgets = new Dashboard_Widgets();

		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'cobolt_admin_scripts' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
//		add_action( 'admin_init', array( $this, 'get_posts_broken_shortcodes' ) );
		$this->handle_options();
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
		 * defined in Cobolt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cobolt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->Cobolt, plugin_dir_url( __FILE__ ) . 'css/cobolt-admin.css', array(), $this->version, 'all' );
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
		 * defined in Cobolt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cobolt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->Cobolt, plugin_dir_url( __FILE__ ) . 'js/cobolt-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Add admin scripts
	 *
	 * @since 1.0.0
	 */
	public function cobolt_admin_scripts() {
		wp_enqueue_script(
			'cobolt-admin',
			plugin_dir_url( __FILE__ ) . 'app/build/index.js',
			array( 'wp-element' ),
			filemtime( plugin_dir_path( __FILE__ ) . 'app/build/index.js' ),
			true
		);
		wp_enqueue_style(
			'cobolt-admin',
			plugin_dir_url( __FILE__ ) . 'app/build/index.css',
			array(),
			filemtime( plugin_dir_path( __FILE__ ) . 'app/build/index.css' ),
			'all'
		);
	}

	/**
	 * Add admin menu item.
	 *
	 * @since 1.0.0
	 */
	public function add_admin_menu() {

		add_menu_page(
			$this->Cobolt,
			'Developer',
			'manage_options',
			$this->Cobolt,
			array( $this, 'cobolt_admin_page' ),
			'dashicons-admin-tools',
			3
		);
//		add_submenu_page(
//			$this->Cobolt,
//			'Documentation',
//			'Documentation',
//			'manage_options',
//			'#docs',
//		);
		add_submenu_page(
			$this->Cobolt,
			'Website Health',
			'Health',
			'manage_options',
			'site_health',
			array( $this, 'site_health' )
		);
		add_submenu_page(
			$this->Cobolt,
			'Broken Links',
			'Broken Links',
			'manage_options',
			'broken_links',
			array( $this, 'broken_links' )
		);
		add_submenu_page(
			$this->Cobolt,
			'Settings',
			'Settings',
			'manage_options',
			'cobolt_settings',
			array( $this, 'cobolt_settings_page' )
		);

	}

	/**
	 * Register settings.
	 */
	public function register_settings() {
		add_settings_section(
			'cobolt_settings',
			'Settings',
			array( $this, 'render_settings_section' ),
			'cobolt_settings'
		);

		unset( $args );
		$args = array(
			'type'       => 'input',
			'subtype'    => 'checkbox',
			'id'         => 'cobolt_staging_mode',
			'name'       => 'cobolt_staging_mode',
			'label'      => 'Staging Mode',
			'value_type' => 'bool',
			'wp_data'    => 'option',
		);

		add_settings_field(
			'cobolt_staging_mode',
			'Staging Mode',
			array( $this, 'render_settings_section' ),
			'cobolt_settings',
			'cobolt_settings',
			$args
		);
		register_setting( 'cobolt_settings', 'cobolt_staging_mode' );

		add_settings_field(
			'cobolt_dock_notices',
			'Dock Notices',
			array( $this, 'render_settings_section' ),
			'cobolt_settings',
			'cobolt_settings',
			array(
				'type'       => 'input',
				'subtype'    => 'checkbox',
				'id'         => 'cobolt_dock_notices',
				'name'       => 'cobolt_dock_notices',
				'label'      => 'Dock Notices',
				'value_type' => 'bool',
				'wp_data'    => 'option',
			)
		);
		register_setting( 'cobolt_settings', 'cobolt_dock_notices' );
	}

	public function handle_options() {
		$staging_mode = get_option( 'cobolt_staging_mode' );
		if ( $staging_mode ) {
			add_action( 'admin_init', array( $this->admin_notices, 'show_staging_notice' ) );
		}

		$dock_notices = get_option( 'cobolt_dock_notices' );
		if ( $dock_notices ) {
			add_action( 'admin_enqueue_scripts', array( $this->admin_notices, 'enqueue_dock_notices_scripts' ) );
			add_action( 'admin_notices', array( $this->admin_notices, 'collapse_notices' ) );
		}
	}

	/**
	 * Admin page.
	 *
	 * @since 1.0.0
	 */
	public function cobolt_admin_page() {
		include_once 'app/templates/app.php';
	}

	/**
	 * Settings page.
	 *
	 * @since 1.0.0
	 */
	public function cobolt_settings_page() {
		include_once 'partials/admin-settings.php';
	}

	/**
	 * Website Health page.
	 *
	 * @since 1.0.0
	 */
	public function site_health() {
		include_once 'partials/site-health.php';
	}

	/**
	 * Website Broken Links
	 *
	 * @since 1.0.0
	 */
	public function broken_links() {
		include_once 'partials/broken-links.php';
	}

	public function render_settings_section() {
		$args       = func_get_args();
		$args       = $args[0];
		$type       = $args['type'];
		$subtype    = $args['subtype'];
		$id         = $args['id'];
		$name       = $args['name'];
		$label      = $args['label'];
		$value_type = $args['value_type'];
		$wp_data    = $args['wp_data'];

		$value = get_option( $id );

		if ( $value_type === 'bool' ) {
			$value = $value ? 'checked' : '';
		}

		if ( $type === 'input' ) {
			if ( $subtype === 'checkbox' ) {
				printf(
					'<input type="checkbox" id="%1$s" name="%2$s" value="1" %3$s />',
					esc_attr( $id ),
					esc_attr( $name ),
					esc_attr( $value )
				);
			}
		}
	}


}
