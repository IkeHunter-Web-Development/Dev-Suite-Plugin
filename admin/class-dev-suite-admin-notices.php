<?php

class Dev_Suite_Admin_Notices {
  public function __construct() {
    // add_action('admin_notices', array($this, 'admin_notice'));
    // add_action('admin_init', array($this, 'create_staging_notice_option'));
    // add_action('admin_init', array($this, 'set_staging_mode'));
    add_action('admin_notices', array($this, 'show_staging_notice'));
  }
  
  public function create_staging_notice_option() {
    add_option('dev_suite_staging_mode', false);
  }

  public function set_staging_mode() {
    update_option('dev_suite_staging_mode', true);
  }
  
  public function show_staging_notice() {
    $staging_mode = get_option('dev_suite_staging_mode');
    if ($staging_mode) {
      add_action('admin_notices', array($this, 'admin_notice'));
      echo '<div class="notice notice-error is-dismissible"><p>Staging Mode is active</p></div>';
    } else {
      echo '<div class="notice notice-success is-dismissible"><p>Staging Mode is not active</p></div>';
    }
  }

  public function admin_notice() {
    $class = 'notice notice-error';
    $title = __('Staging Site Is Active!', 'development-suite');
    $message = __('Warning: Staging site is active, make all changes there first. All data on the production site will be overwritten with the staging data.', 'development-suite');
    $staging_url = 'https://staging.thewanderingrv.com';

    printf(
      '
            <div class="%1$s">
                <h2>%4$s</h2>
                <p>%2$s</p>
                <p>Staging Site: <a href="%3$s">%3$s</a></p>
            </div>
            ',
      esc_attr($class),
      esc_html($message),
      esc_html($staging_url),
      esc_html($title)
    );
  }
}
