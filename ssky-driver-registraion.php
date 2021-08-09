<?php 
/*
  Plugin Name: Driver Registration for WooCommerce
  Plugin URI:  #
  Description: Driver Registration for Delivery Drivers for WooCommerce Plugin
  Version:     1.0.0
  Author:      Sasky
  Author URI:  https://github.com/saskysamonte/driver-registration-for-wooCommerce/
  License:     GPL2 or later
  License URI: http://www.gnu.org/licenses/gpl-2.0.txt
  Domain Path: /languages/
  Text Domain: ssky_driver_registration
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if ( ! defined( 'SSKY_DRIVER_REGISTRATION_VERSION' ) ) {
    define( 'SSKY_DRIVER_REGISTRATION_VERSION', '1.0.0' ); // SSKY: DEFINED_VERSION.
    defined('SSKY_DRIVER_REGISTRATION_FILE') or define('SSKY_DRIVER_REGISTRATION_FILE',plugin_dir_path(__FILE__));
}

// Plugin init hook.
add_action( 'plugins_loaded', 'ssky_driver_registration_init', 1 );

/**
 * Initialize plugin.
 */
function ssky_driver_registration_init() {
  
	if ( ! class_exists( 'DDWC' ) ) {
      add_action( 'admin_notices', 'ssky_driver_registration_deactivated' );
      return;
	}

	require_once __DIR__ . '/class-ssky-driver-registration.php';
	new SSKY_Driver_Registration();
}

/**
 * WooCommerce and Delivery Driver for WooCommerce Deactivated Notice.
 */
function ssky_driver_registration_deactivated() {
	  /* translators: %s: WooCommerce link */
	  echo '<div class="error"><p>' . sprintf( esc_html__( 'Driver Registration requires %s to be installed and active.', 'ssky-driver-registraion' ), '<a href="https://wordpress.org/plugins/delivery-drivers-for-woocommerce/" target="_blank">Delivery Drivers for WooCommerce</a>' ) . '</p></div>';
    //echo '<div class="error"><p>' . sprintf( esc_html__( 'WooCommerce Distance Rate Shipping requires %s to be installed and active.', 'woocommerce-distance-rate-shipping' ), '<a href="https://woocommerce.com/" target="_blank">WooCommerce</a>' ) . '</p></div>';
}


/*
 * Validate Driver Email Verified 
*/
if ( !function_exists('wp_authenticate') ) {

  function wp_authenticate($username, $password) {
      $username = sanitize_user($username);
      $password = trim($password);
      $user = apply_filters('authenticate', null, $username, $password);
      if ( get_user_meta( $user->ID, 'ssky_driver_verify_email', true ) == 'no' ) {
          $user = new WP_Error('activation_failed', __('<strong>FAILED</strong>: Please check your email and complete email verification to login.'));
      }
      $ignore_codes = array('empty_username', 'empty_password');
      if (is_wp_error($user) && !in_array($user->get_error_code(), $ignore_codes) ) {
          do_action('wp_login_failed', $username);
      }
      return $user;
  }
  
}