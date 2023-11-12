<?php

class Dev_Suite_Admin_Notices {
	public function __construct() {
		// add_action('admin_notices', array($this, 'admin_notice'));
		// add_action('admin_init', array($this, 'create_staging_notice_option'));
		// add_action('admin_init', array($this, 'set_staging_mode'));
//    add_action('admin_notices', array($this, 'show_staging_notice'));
		add_action( 'admin_init', array( $this, 'show_staging_notice' ) );
	}

	public function create_staging_notice_option() {
		add_option( 'dev_suite_staging_mode', false );
	}

	public function set_staging_mode() {
		update_option( 'dev_suite_staging_mode', true );
	}

	public function show_staging_notice() {
		$staging_mode = get_option( 'dev_suite_staging_mode' );
		if ( $staging_mode ) {
			add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		}
	}

	public function admin_notice() {
		$class   = 'notice notice-error';
		$title   = __( 'Staging Site Is Active!', 'development-suite' );
		$message = __( 'Warning: Staging site is active, all data on this site will be overwritten with the staging data.', 'development-suite' );

		printf(
			'
        <div class="%1$s">
            <h2>%3$s</h2>
            <p>%2$s</p>
        </div>
        ',
			esc_attr( $class ),
			esc_html( $message ),
			esc_html( $title )
		);
	}
}
