<?php
/**
 * Frontend Driver Profile 
 * Add Driver details to WooCommerce My Account page.
 *
 * @package SSKY_Driver_Registration
 * @author Sasky Samonte 
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



/*
 * WooCommerce hook edit account form
 */
add_action( 'woocommerce_edit_account_form', 'ssky_add_to_edit_account_form' );

/*
 * Callback display custom fields on Driver's account on WooCommerce My Account page
 */

function ssky_add_to_edit_account_form() {
  // Get user data.
  $user_id         = get_current_user_id();
  $user            = get_userdata( $user_id );
  // If the user is a DRIVER, display the driver fields.
  if ( in_array( 'driver', (array) $user->roles ) ) { ?>
  <fieldset>
      <legend>Other Information</legend>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_registration_no">
          <?php
              esc_html_e( 'Registration No.', 'ddwc' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_registration_no" id="ssky_driver_registration_no" value="<?= get_user_meta( $user->ID, 'ssky_driver_registration_no', true ); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_expiration">
          <?php
              esc_html_e( 'Expiration', 'ddwc' );
          ?>
          </label>
          <input type="date" class="input-text" name="ssky_driver_expiration" id="ssky_driver_expiration" value="<?= get_user_meta( $user->ID, 'ssky_driver_expiration', true ); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_registered_owner">
          <?php
              esc_html_e( 'Registered Owner', 'ddwc' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_registered_owner" id="ssky_driver_registered_owner" value="<?= get_user_meta( $user->ID, 'ssky_driver_registered_owner', true ); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_chasis_engine_no">
          <?php
              esc_html_e( 'Chasis / Engine No.', 'ddwc' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_chasis_engine_no" id="ssky_driver_chasis_engine_no" value="<?= get_user_meta( $user->ID, 'ssky_driver_chasis_engine_no', true ); ?>" />
      </p>

  </fieldset>

  <fieldset>
      <legend>Payment Details</legend>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_paypal">
          <?php
              esc_html_e( 'Paypal', 'ssky_driver_registration' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_paypal" id="ssky_driver_paypal" value="<?= get_user_meta( $user->ID, 'ssky_driver_paypal', true ); ?>" />
      </p>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_gcash">
          <?php
              esc_html_e( 'GCash', 'ssky_driver_registration' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_gcash" id="ssky_driver_gcash" value="<?= get_user_meta( $user->ID, 'ssky_driver_gcash', true ); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_bank_account_name">
          <?php
              esc_html_e( 'Bank Account Name', 'ssky_driver_registration' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_bank_account_name" id="ssky_driver_bank_account_name" value="<?= get_user_meta( $user->ID, 'ssky_driver_bank_account_name', true ); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_bank_account_number">
          <?php
              esc_html_e( 'Bank Account Number', 'ssky_driver_registration' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_bank_account_number" id="ssky_driver_bank_account_number" value="<?= get_user_meta( $user->ID, 'ssky_driver_bank_account_number', true ); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_bank_name">
          <?php
              esc_html_e( 'Bank Name', 'ssky_driver_registration' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_bank_name" id="ssky_driver_bank_name" value="<?= get_user_meta( $user->ID, 'ssky_driver_bank_name', true ); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_bank_address">
          <?php
              esc_html_e( 'Bank Address', 'ssky_driver_registration' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_bank_address" id="ssky_driver_bank_address" value="<?= get_user_meta( $user->ID, 'ssky_driver_bank_address', true ); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_bank_routing">
          <?php
              esc_html_e( 'Routing Number', 'ssky_driver_registration' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_bank_routing" id="ssky_driver_bank_routing" value="<?= get_user_meta( $user->ID, 'ssky_driver_bank_routing', true ); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_bank_iban">
          <?php
              esc_html_e( 'IBAN', 'ssky_driver_registration' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_bank_iban" id="ssky_driver_bank_iban" value="<?= get_user_meta( $user->ID, 'ssky_driver_bank_iban', true ); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="ssky_driver_bank_swiftcode">
          <?php
              esc_html_e( 'Swift Code', 'ssky_driver_registration' );
          ?>
          </label>
          <input type="text" class="input-text" name="ssky_driver_bank_swiftcode" id="ssky_driver_bank_swiftcode" value="<?= get_user_meta( $user->ID, 'ssky_driver_bank_swiftcode', true ); ?>" />
      </p>
  </fieldset>

  <?php
  }
}

