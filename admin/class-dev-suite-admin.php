<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Dev_Suite
 * @subpackage Dev_Suite/admin
 */
require_once plugin_dir_path(__FILE__) . 'class-dev-suite-admin-notices.php';

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dev_Suite
 * @subpackage Dev_Suite/admin
 * @author     Your Name <email@example.com>
 */
class Dev_Suite_Admin {

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string $Dev_Suite The ID of this plugin.
   */
  private $Dev_Suite;

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
   * @param string $Dev_Suite The name of this plugin.
   * @param string $version The version of this plugin.
   *
   * @since    1.0.0
   */
  public function __construct($Dev_Suite, $version) {

    $this->Dev_Suite = $Dev_Suite;
    $this->version   = $version;

    $this->admin_notices = new Dev_Suite_Admin_Notices();

    add_action('admin_menu', array($this, 'add_admin_menu'));
    add_action('admin_init', array($this, 'register_settings'));
    add_action('admin_enqueue_scripts', array($this, 'dev_suite_admin_scripts'));
    
    add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
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
     * defined in Dev_Suite_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Dev_Suite_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_style($this->Dev_Suite, plugin_dir_url(__FILE__) . 'css/dev-suite-admin.css', array(), $this->version, 'all');
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
     * defined in Dev_Suite_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Dev_Suite_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_script($this->Dev_Suite, plugin_dir_url(__FILE__) . 'js/dev-suite-admin.js', array('jquery'), $this->version, false);
  }

  /**
   * Add admin menu item.
   *
   * @since 1.0.0
   */
  public function add_admin_menu() {

    add_menu_page(
      $this->Dev_Suite,
      'Dev Suite',
      'manage_options',
      $this->Dev_Suite,
      array($this, 'dev_suite_admin_page'),
      'dashicons-admin-tools',
      3
    );
    add_submenu_page(
      $this->Dev_Suite,
      'Documentation',
      'Documentation',
      'manage_options',
      '#docs',
    );
    add_submenu_page(
      $this->Dev_Suite,
      'Settings',
      'Settings',
      'manage_options',
      'dev_suite_settings',
      array($this, 'dev_suite_settings_page')
    );
  }

  /**
   * Register settings.
   */
  public function register_settings() {
    add_settings_section(
      'dev_suite_settings',
      'Settings',
      array($this, 'render_settings_section'),
      'dev_suite_settings'
    );

    unset($args);
    $args = array(
      'type'       => 'input',
      'subtype'    => 'checkbox',
      'id'         => 'dev_suite_staging_mode',
      'name'       => 'dev_suite_staging_mode',
      'label'      => 'Staging Mode',
      'value_type' => 'bool',
      'wp_data'    => 'option',
    );
    add_settings_field(
      'dev_suite_staging_mode',
      'Staging Mode',
      array($this, 'render_settings_section'),
      'dev_suite_settings',
      'dev_suite_settings',
      $args
    );

    register_setting('dev_suite_settings', 'dev_suite_staging_mode');
  }

  /**
   * Admin page.
   *
   * @since 1.0.0
   */
  public function dev_suite_admin_page() {
    include_once 'app/templates/app.php';
  }

  /**
   * Add admin scripts
   * 
   * @since 1.0.0
   */
  public function dev_suite_admin_scripts() {
    wp_enqueue_script(
      'dev-suite-admin',
      plugin_dir_url(__FILE__) . 'app/build/index.js',
      array('wp-element'),
      filemtime(plugin_dir_path(__FILE__) . 'app/build/index.js'),
      true
    );
    wp_enqueue_style(
      'dev-suite-admin',
      plugin_dir_url(__FILE__) . 'app/build/index.css',
      array(),
      filemtime(plugin_dir_path(__FILE__) . 'app/build/index.css'),
      'all'
    );
  }

  /**
   * Settings page.
   * 
   * @since 1.0.0
   */
  public function dev_suite_settings_page() {
    include_once 'partials/dev-suite-admin-settings.php';
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

    $value = get_option($id);

    if ($value_type === 'bool') {
      $value = $value ? 'checked' : '';
    }

    if ($type === 'input') {
      if ($subtype === 'checkbox') {
        printf(
          '<input type="checkbox" id="%1$s" name="%2$s" value="1" %3$s />',
          esc_attr($id),
          esc_attr($name),
          esc_attr($value)
        );
      }
    }
  }
}
