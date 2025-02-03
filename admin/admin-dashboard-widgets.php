<?php

namespace Cobolt\Admin;

class Dashboard_Widgets {
	public function __construct() {
		add_action( 'wp_dashboard_setup', array( $this, 'remove_welcome' ) );
		add_action( 'wp_dashboard_setup', array( $this, 'add_top_widget' ) );
	}

	public function remove_welcome() {
		remove_action( 'welcome_panel', 'wp_welcome_panel' );
		add_action( 'welcome_panel', function () {
			include_once 'app/templates/welcome-panel.php';
		} );
	}

	public function render_top_widget() {
		esc_html_e( "Hello admin" );
	}

	public function add_top_widget() {
		wp_add_dashboard_widget( 'cobolt-welcome', esc_html__( 'Welcome!' ), array( $this, 'render_top_widget' ) );

		global $wp_meta_boxes;
		$default_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
		$new_widget_backup = array( 'cobolt-welcome' => $default_dashboard['cobolt-welcome'] );
		unset( $default_dashboard['cobolt-welcome'] );

		$sorted_dashboard                             = array_merge( $new_widget_backup, $default_dashboard );
		$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
	}
}