<?php

namespace Cobolt\Admin;

class Cobolt_Admin_Notices {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $Cobolt The ID of this plugin.
	 */
	private string $Cobolt;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private string $version;

	public function __construct( $Cobolt ) {
		// add_action('admin_notices', array($this, 'admin_notice'));
		// add_action('admin_init', array($this, 'create_staging_notice_option'));
		// add_action('admin_init', array($this, 'set_staging_mode'));
//    add_action('admin_notices', array($this, 'show_staging_notice'));
//		add_action( 'admin_init', array( $this, 'show_staging_notice' ) );
//		add_action( 'admin_notices', array( $this, 'collapse_notices' ) );
		$this->Cobolt = $Cobolt;
		$this->version   = COBOLT_VERSION;
	}

	public function create_staging_notice_option() {
		add_option( 'cobolt_staging_mode', false );
	}

	public function set_staging_mode() {
		update_option( 'cobolt_staging_mode', true );
	}

	public function show_staging_notice() {
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
//		$staging_mode = get_option( 'cobolt_staging_mode' );
//		if ( $staging_mode ) {
//			add_action( 'admin_notices', array( $this, 'admin_notice' ) );
//		}
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

	public function collapse_notices() {

		?>
        <div id="notices-dock">
            <div id="notices-dock__body"></div>
        </div>
        <button type="button" id="notices-dock__toggle">Notifications</button>
		<?php
	}

	public function enqueue_dock_notices_scripts() {
		wp_enqueue_script( $this->Cobolt . '-dock-notices', plugin_dir_url( __FILE__ ) . 'js/dock-notices.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_style( $this->Cobolt . '-dock-notices', plugin_dir_url( __FILE__ ) . 'css/dock-notices.css', array(), $this->version, 'all' );
	}
}
