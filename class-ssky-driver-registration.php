<?php
/**
 * Plugin main class.
 *
 * @package ssky-driver-registraion
 */

/**
 * Driver Registration plugin class.
 */
class SSKY_Driver_Registration {
	/**
	 * Plugin's version.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version;

	/**
	 * Constructor.
	 */
	public function __construct() {
			$this->version = SSKY_DRIVER_REGISTRATION_VERSION;
			add_action( 'init', array($this,'ssky_init') );
	}

	/**
	 * Loads any class that needs to check for WC loaded.
	 *
	 * @since 1.0.9
	 */
	public function ssky_init() {
		require_once SSKY_DRIVER_REGISTRATION_FILE.'includes/frontend/registration.php';
		require_once SSKY_DRIVER_REGISTRATION_FILE.'includes/frontend/profile.php';
		require_once SSKY_DRIVER_REGISTRATION_FILE.'includes/backend/profile.php';
	}

}
