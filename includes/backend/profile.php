<?php
/**
 * Backend Driver Profile 
 * WordPress Custom User Fields
 *
 * @package SSKY_Driver_Registration
 * @author Sasky Samonte 
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*
 * Add the field to user's own profile editing screen.
 */
add_action('show_user_profile','ssky_usermeta_driver_information_field');

/*
 * Add the field to user profile editing screen.
 */
add_action('edit_user_profile', 'ssky_usermeta_driver_information_field');
  
/*
 * Callback user profile fields
 */
function ssky_usermeta_driver_information_field( $user )
{

    $roles = ( array ) $user->roles;
    $current_role = $roles[0]; 

    // If the user is a DRIVER, display the driver fields.
    if ( $current_role == 'driver') { ?>
    <h3>Driver's Other Information</h3>
    <table class="form-table">
        <tr>
          <th><label for="ssky_driver_registration_no">Registration No. <?= get_user_meta( $user->ID, 'ssky_driver_verified', true ) ?></label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_registration_no"
                       name="ssky_driver_registration_no"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_registration_no', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>

        <tr>
          <th><label for="ssky_driver_expiration">Expiration</label></th>
            <td>
                <input type="date"
                       class="regular-text ltr"
                       id="ssky_driver_expiration"
                       name="ssky_driver_expiration"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_expiration', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>

        <tr>
          <th><label for="ssky_driver_registered_owner">Registered Owner</label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_registered_owner"
                       name="ssky_driver_registered_owner"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_registered_owner', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>

        <tr>
          <th><label for="ssky_driver_chasis_engine_no">Chasis / Engine No.</label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_chasis_engine_no"
                       name="ssky_driver_chasis_engine_no"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_chasis_engine_no', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>
        <?php
            if ( get_user_meta( $user->ID, 'ssky_driver_verified', true ) == 'yes' ) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
        ?>
        <tr>
          <th><label for="ssky_driver_verified">Driver Verified?</label></th>
            <td>
               <input class="regular-text" type="checkbox" name="ssky_driver_verified" <?php esc_attr_e( $checked ); ?>> Is the driver verified?</td>
        </tr>
    </table>

    <h3>Driver's Payment Details</h3>
    <table class="form-table">
        <tr>
          <th><label for="ssky_driver_paypal">Paypal</label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_paypal"
                       name="ssky_driver_paypal"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_paypal', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>
        <tr>
          <th><label for="ssky_driver_gcash">GCash</label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_gcash"
                       name="ssky_driver_gcash"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_gcash', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>

        <tr>
          <th><label for="ssky_driver_bank_account_name">Bank Account Name</label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_bank_account_name"
                       name="ssky_driver_bank_account_name"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_bank_account_name', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>

        <tr>
          <th><label for="ssky_driver_bank_account_number">Bank Account Number</label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_bank_account_number"
                       name="ssky_driver_bank_account_number"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_bank_account_number', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>

        <tr>
          <th><label for="ssky_driver_bank_name">Bank Name</label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_bank_name"
                       name="ssky_driver_bank_name"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_bank_name', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>

        <tr>
          <th><label for="ssky_driver_bank_address">Bank Address</label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_bank_address"
                       name="ssky_driver_bank_address"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_bank_address', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>

        <tr>
          <th><label for="ssky_driver_bank_routing">Routing</label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_bank_routing"
                       name="ssky_driver_bank_routing"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_bank_routing', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>

        <tr>
          <th><label for="ssky_driver_bank_iban">IBAN</label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_bank_iban"
                       name="ssky_driver_bank_iban"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_bank_iban', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>

        <tr>
          <th><label for="ssky_driver_bank_swiftcode">Swift Code</label></th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="ssky_driver_bank_swiftcode"
                       name="ssky_driver_bank_swiftcode"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'ssky_driver_bank_swiftcode', true ) ) ?>"
                       title=""
                       pattern="">
            </td>
        </tr>
    </table>

    <?php
  }
}


  
/*
 * Add the save action to user's own profile editing screen update.
 */
add_action('personal_options_update','ssky_usermeta_driver_information_field_update');
  
/*
 * Add the save action to user profile editing screen update.
 */
add_action('edit_user_profile_update','ssky_usermeta_driver_information_field_update');

/**
 * Callback of User update/save custom fields 
 *
 * @param $user_id int the ID of the current user.
 * @return bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function ssky_usermeta_driver_information_field_update( $user_id )
{
    // Check that the current user have the capability to edit the $user_id
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    //Driver's Other Information
    $update_meta[] = update_user_meta($user_id,'ssky_driver_registration_no', $_POST['ssky_driver_registration_no']);
    $update_meta[] = update_user_meta($user_id,'ssky_driver_expiration', $_POST['ssky_driver_expiration']);
    $update_meta[] = update_user_meta($user_id,'ssky_driver_registered_owner', $_POST['ssky_driver_registered_owner']);
    $update_meta[] = update_user_meta($user_id,'ssky_driver_chasis_engine_no', $_POST['ssky_driver_chasis_engine_no']);

    //Driver's Payment Details
    $update_meta[] = update_user_meta($user_id,'ssky_driver_paypal', $_POST['ssky_driver_paypal']);
    $update_meta[] = update_user_meta($user_id,'ssky_driver_gcash', $_POST['ssky_driver_gcash']);
    $update_meta[] = update_user_meta($user_id,'ssky_driver_bank_account_name', $_POST['ssky_driver_bank_account_name']);
    $update_meta[] = update_user_meta($user_id,'ssky_driver_bank_account_number', $_POST['ssky_driver_bank_account_number']);
    $update_meta[] = update_user_meta($user_id,'ssky_driver_bank_name', $_POST['ssky_driver_bank_name']);
    $update_meta[] = update_user_meta($user_id,'ssky_driver_bank_address', $_POST['ssky_driver_bank_address']);
    $update_meta[] = update_user_meta($user_id,'ssky_driver_bank_routing', $_POST['ssky_driver_bank_routing']);
    $update_meta[] = update_user_meta($user_id,'ssky_driver_bank_iban', $_POST['ssky_driver_bank_iban']);
    $update_meta[] = update_user_meta($user_id,'ssky_driver_bank_swiftcode', $_POST['ssky_driver_bank_swiftcode']);

    if ( $_POST['ssky_driver_verified'] ) {
        $update_meta[] = update_user_meta($user_id,'ssky_driver_verified', 'yes');
        

        $driver_user  = new WP_User( $user_id );

        $user_login = stripslashes( $driver_user->user_login );
        $user_email = stripslashes( $driver_user->user_email );
        $fname      =  get_user_meta( $driver_user->ID, 'first_name', true );
        $lname      =  get_user_meta( $driver_user->ID, 'last_name', true );
        $fullname = $fname . ' ' . $lname;
        
        $login_link = get_site_url() . "/my-account/";
        $email_admin = get_option('woocommerce_email_from_address'); //WooCommerce Email sender options "From" address
        $from_admin = get_option('woocommerce_email_from_name');  //WooCommerce Email sender options "From" name

        $message = sprintf( __('Hi %s,'), $fullname ) . "<br/><br/>";
        $message .= sprintf( __('Congratulations! Your Account Registration with [%s] is now approved.'), get_option('blogname') ) . "<br/>";
        $message .= "<p>We will send you a message for the system and company orientation schedule via online</p>";
        $message .= "<p><b>Please note and remember the following:</b></p>";
        $message .= "<p>1. Please make sure that you have carefully read the terms and conditions of our transport Agreement.<br/>";
        $message .= "2. Never share your account to anyone. Ensure the safety and security of your shopnsell account. We suggest to Change your password regularly or at least once a month.<br/>";
        $message .= "3. Provide to " .  get_option('blogname') . " your bank account for the remittance of your weekly earnings.<br/>";
        $message .= "4. Make sure that you have internet connections all the time to accept Assignment of order from Shopnsell and to monitor your dashboard including sending of notifications to customers, sellers, and ShopNsell.<br/>";
        $message .= "5. Always wear proper and complete PPE or safety gear when driving or sending delivery/parcels to customers.<br/>";
        $message .= "6. Handle the parcels/goods/items with care.<br/>";
        $message .= "7. In case of cash-on-delivery payment by customer, immediately remit the full amount to " .  get_option('blogname') . " via bank transfer or cash to " .  get_option('blogname') . " treasurer.<br/>";
        $message .= "8. Afford respect and honesty to customers and ensure efficiency and excellent quality of your service.<br/>";
        $message .= "9. Follow or obey traffic rules.<br/>";
        $message .= "10. Drive safely. Drive with us, drive with Shopnsell!</p>";

        $message .= "<p>Thank you so much!<br/>";
        $message .= "<p>$from_admin <br/>";
        $message .= sprintf( __('If you have any problems, please contact us at %s.'), get_option('admin_email') ) . "<br/>";
        $headers = array('Content-Type: text/html; charset=UTF-8');

        $is_verify     = get_user_meta( $driver_user->ID, 'ssky_driver_verified', true );
        $is_sent       = get_user_meta( $driver_user->ID, 'ssky_driver_verified_sent_email', true );

        if($is_verify == 'yes' && $is_sent == 'no') {
            wp_mail(
                $user_email,
                sprintf(__('Congratulations! Your Account Registration with [%s] is now approved.'), get_option('blogname') ),
                $message,
                $headers
            );
            $update_meta[] = update_user_meta($driver_user->ID,'ssky_driver_verified_sent_email', 'yes');
        }

    } else {
        $update_meta[] = update_user_meta($user_id,'ssky_driver_verified', 'no');
        $update_meta[] = update_user_meta($user_id,'ddwc_driver_availability', '');
    }
    return $update_meta;

}
