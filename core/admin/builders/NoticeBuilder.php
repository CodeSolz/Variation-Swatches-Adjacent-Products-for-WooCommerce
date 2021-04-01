<?php namespace WooVarSwatchesAdjacentProducts\admin\builders;

/**
 * Custom Notice
 *
 * @package Notices
 * @since 1.0.0
 * @author M.Tuhin <tuhin@codesolz.net>
 */

if ( ! defined( 'CS_WVSAP_VERSION' ) ) {
	exit;
}


class NoticeBuilder {

	private static $_instance;
	private $admin_notices;
	const TYPES = 'error,warning,info,success';

	private function __construct() {
		$this->admin_notices = new \stdClass();
		foreach ( explode( ',', self::TYPES ) as $type ) {
			$this->admin_notices->{$type} = array();
		}

		add_action( 'admin_init', array( $this, 'cs_wvsap_action_admin_init' ) );
		add_action( 'admin_notices', array( $this, 'cs_wvsap_action_admin_notices' ) );
	}

	/**
	 * generate instance
	 *
	 * @return void
	 */
	public static function get_instance() {
		if ( ! ( self::$_instance instanceof self ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Admin init
	 *
	 * @return void
	 */
	public function cs_wvsap_action_admin_init() {
		$dismiss_option = filter_input( INPUT_GET, CS_WVSAP_NOTICE_ID, FILTER_SANITIZE_STRING );
		if ( is_string( $dismiss_option ) ) {
			update_option( CS_WVSAP_NOTICE_ID . 'ed_' . $dismiss_option, true );
			wp_die();
		}
	}

	/**
	 * Init notices
	 *
	 * @return void
	 */
	public function cs_wvsap_action_admin_notices() {

		global $my_admin_page, $wvsap_menu;
		$screen = get_current_screen();

		if ( is_array( $wvsap_menu ) && \in_array( $screen->id, $wvsap_menu ) ) {
			return;
		}

		foreach ( explode( ',', self::TYPES ) as $type ) {
			foreach ( $this->admin_notices->{$type} as $admin_notice ) {

				$dismiss_url = add_query_arg(
					array(
						CS_WVSAP_NOTICE_ID => $admin_notice->dismiss_option,
					),
					admin_url()
				);

				if ( ! get_option( CS_WVSAP_NOTICE_ID . "ed_{$admin_notice->dismiss_option}" ) ) {

					$dissmissUrl = '';
					$canDissmiss = '';
					if ( $admin_notice->dismiss_option ) {
						$canDissmiss = ' is-dismissible';
						$dissmissUrl = ' data-dismiss-url="' . esc_url( $dismiss_url ) . '"';
					}

					?><div class="notice cs-notice notice-<?php echo $type . $canDissmiss; ?>" <?php echo $dissmissUrl; ?>>
						<p>
							<strong><?php echo CS_WVSAP_PLUGIN_NAME; ?></strong>
						</p>
						<p><?php echo $admin_notice->message; ?></p>

					</div>
						<?php
				}
			}
		}
	}

	public function error( $message, $dismiss_option = false ) {
		$this->notice( 'error', $message, $dismiss_option );
	}

	public function warning( $message, $dismiss_option = false ) {
		$this->notice( 'warning', $message, $dismiss_option );
	}

	public function success( $message, $dismiss_option = false ) {
		$this->notice( 'success', $message, $dismiss_option );
	}

	public function info( $message, $dismiss_option = false ) {
		$this->notice( 'info', $message, $dismiss_option );
	}

	private function notice( $type, $message, $dismiss_option ) {
		$notice                 = new \stdClass();
		$notice->message        = $message;
		$notice->dismiss_option = $dismiss_option;

		$this->admin_notices->{$type}[] = $notice;
	}

}


