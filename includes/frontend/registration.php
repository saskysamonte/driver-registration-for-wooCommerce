<?php
/**
 * Frontend Registration 
 * shortocde
 *
 * @package SSKY_Driver_Registration
 * @author Sasky Samonte 
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*
 * Frontend Registration Form 
*/
function ssky_driver_registration_form( $first_name, $last_name, $username, $password, $email) {
    global $username, $password, $email, $first_name, $last_name;
    echo '
        <form id="ssky-driver-registration-form" action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            '. wp_nonce_field( 'ssky_driver_nonce' ) . '

        <p>
                <label for="fname">First Name <span class="required">*</span></label>
                <input type="text" name="fname" id="fname" required="required">
        </p>

        <p>
                <label for="lname">Last Name <span class="required">*</span></label>
                <input type="text" name="lname" id="lname" required="required">
        </p>

        <p class="form-row form-group form-row-wide">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email"  name="email" id="email" required="required">
        </p>

        <p>
            <label for="phone">Phone Number<span class="required">*</span></label>
            <input type="text" name="phone" id="phone" required="required">
        </p>

        <p>
                <label for="username">Username <span class="required">*</span></label>
                <input type="text" ame="username" id="username" required="required">
        </p>

        <p>
                <label for="password">Password <span class="required">*</span></label>
                <input type="password" name="password" id="password" required="required">
        </p>
        <p>
                <input class="tc_check_box" type="checkbox" id="ssky_driver_agree" required="required">
                <label style="display: inline" for="tc_agree">I have read and agree to the <a target="_blank" href="' . site_url() . '/drivers-agreement/">Terms &amp; Conditions</a>.</label>
        </p>
        <input type="submit" name="submit" value="Register"/>
        </form>
    ';
}


/*
 * Validate Driver Registration Inputs 
*/
function ssky_driver_registration_validation( $username, $password, $email)  {
    global $customize_error_validation;
    $customize_error_validation = new WP_Error;
    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $customize_error_validation->add('field', ' Please Fill the filed of WordPress registration form');
    }

    if ( email_exists( $email ) )
        $customize_error_validation->add('email', ' Email is already taken* Please choose another email!');

    if ( username_exists( $username ) )
        $customize_error_validation->add('user_name', ' Username is already taken* Please choose another username!');

    if ( is_wp_error( $customize_error_validation ) ) {
        foreach ( $customize_error_validation->get_error_messages() as $error ) {
            echo '<span style="color: red;"><strong>';
            echo $error . '</strong></span><br/>';
        }
    }
}


/*
 * Driver Registration Insert and Update to User table 
 */
function ssky_driver_registration_completion() {

    global $customize_error_validation, $username, $password, $email, $first_name, $last_name;
    $post_data = wp_unslash( $_POST );
    $nonce     = isset( $post_data['_wpnonce'] ) ? $post_data['_wpnonce'] : '';

    //Validate WordPress Nonce
    if ( ! wp_verify_nonce( $nonce, 'ssky_driver_nonce' ) ) {
        return;
    }

    if ( 1 > count( $customize_error_validation->get_error_messages() ) ) {
        $userdata = array(
            'first_name'    =>   sanitize_text_field( $first_name ),
            'last_name'     =>   sanitize_text_field( $last_name ),
            'user_login'    =>   sanitize_text_field( $username ),
            'user_email'    =>   sanitize_text_field( $email ),
            'user_pass'     =>   sanitize_text_field( $password ),
            'role'          =>  'driver'
        );

        $phone = sanitize_text_field( $post_data['phone'] );
        $user = wp_insert_user( $userdata );
        update_user_meta( $user, 'billing_phone', $phone ); //Update billing phone meta from WooCommmerce
        update_user_meta( $user, 'ssky_driver_agree', 'yes' ); //Create new Driver Meta Driver Agree 'yes|no'
        update_user_meta( $user, 'ssky_driver_verify_email', 'no' ); //Create new Driver Meta Verify Email  'yes|no'
        update_user_meta( $user, 'ssky_driver_verified', 'no' ); //Create new Driver Meta Verify Driver account  'yes|no'
        update_user_meta( $user, 'ssky_driver_verified_sent_email', 'no' ); //Create new Driver Meta for validation if vereified already  'yes|no'
        ssky_new_driver_registration_notification( $user, $first_name, $last_name);
        echo 'Thank you for registration. please check your inbox for email verification and <a href="' . get_site_url() . '/my-account/">login here</a>.';
    }
}



/**
  * Driver Registration Function
  * @param  string $first_name   First Name
  * @param  string $last_name    Last Name
  * @param  string $username     Username
  * @param  string $password     Password
  * @param  string $email        Email
  * @return array
 */
function ssky_driver_registration_form_function() {
    global $first_name, $last_name, $username, $password, $email;
    if ( isset($_POST['submit'] ) ) {
        ssky_driver_registration_validation(
            $_POST['username'],
            $_POST['password'],
            $_POST['email'],
            $_POST['fname'],
            $_POST['lname']
       );
        $username   =   sanitize_user( $_POST['username'] );
        $password   =   esc_attr( $_POST['password'] );
        $email      =   sanitize_email( $_POST['email'] );
        $first_name =   sanitize_text_field( $_POST['fname'] );
        $last_name  =   sanitize_text_field( $_POST['lname'] );
        ssky_driver_registration_completion(
            $username,
            $password,
            $email,
            $first_name,
            $last_name
        );
    }
    ssky_driver_registration_form(
        $username,
        $password,
        $email,
        $first_name,
        $last_name
    );
}
 

/*
 * Frontend Driver Registration Form Shortcode
 */
add_shortcode( 'ssky_driver_registration', 'ssky_driver_registration_shortcode' );
    function ssky_driver_registration_shortcode() {
    if ( is_user_logged_in() ) {
        $already_login = 'You are already logged in';
        return $already_login; 
    } else {
        ob_start();
        ssky_driver_registration_form_function();
        return ob_get_clean();
    }
    
}

/*
 * Send email to driver and Admin for confirmation
*/
function ssky_new_driver_registration_notification( $user_id, $first_name, $last_name ) {

        $user = new WP_User( $user_id );

        $user_login = stripslashes( $user->user_login );
        $user_email = stripslashes( $user->user_email );
        $driver_name = $first_name . ' ' . $last_name;
        $driver_phone = stripslashes( $user->billing_phone );
        $admin_email = get_option('woocommerce_email_from_address'); //WooCommerce Email sender options "From" address

        $code = sha1( $user_id . time() ); //Generate verification code
        $activation_link = add_query_arg( array( 'key' => $code, 'user' => $user_id ), get_permalink( get_page_by_path( 'my-account' ) ));
        add_user_meta( $user_id, 'ssky_driver_verification_code', $code, true );  //Insert verification code
 
        $message  = sprintf( __('New driver registration on %s:'), get_option('blogname') ) . "<br/><br/>";
        $message .= sprintf( __('Driver Name: %s'), $driver_name ) . "<br/>";
        $message .= sprintf( __('Mobile Number: %s'), $driver_phone ) . "<br/>";
        $message .= sprintf( __('Username: %s'), $user_login ) . "<br/>";
        $message .= sprintf( __('E-mail: %s'), $user_email ) . "<br/>";
        $headers = array('Content-Type: text/html; charset=UTF-8');
        @wp_mail(
            $admin_email,
            sprintf(__('[%s] New Driver Registration'), get_option('blogname') ),
            $message,
            $headers
        );

        $login_link = get_site_url() . '/my-account';
        //$message  = __('Hi there,') . "\r\n\r\n";
        $message = sprintf( __('Hi %s,'), $driver_name ) . "<br/><br/>";
        $message .= sprintf( __("Thank you for creating an account on %s."), get_option('blogname')) . "\r\n";
        $message .= sprintf( __('Your username is %s.'), $user_login ) . "<br/>";
        $message .= "<p>You can access your account area to view assigned orders, change your password,</p>";
        $message .= "<p>and more at: <a href=".$login_link.">" .$login_link. "</a></p>";
        $message .= "<p><b>To Verify your Email</b> <a href=".$activation_link.">Click here</a>.</p>";
        $message .= sprintf( __('If you have any problems, please contact us at %s.'), get_option('admin_email') ) . "<br/><br/>"; //WordPress Admin Email
        $message .= sprintf( get_option('blogname') ) . "<br/>";
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail(
            $user_email,
            sprintf(  __("Your Driver's account has been created!") ),
            $message,
            $headers
        );
        return $message;
}

    
/*
 * Driver's Account Activation 
*/
add_action( 'template_redirect', 'ssky_driver_activate_email' );
function ssky_driver_activate_email() {
    global $post;
    $page_slug = $post->post_name;
    if ( is_page() && $page_slug == 'my-account' ) {
        $user_id = filter_input( INPUT_GET, 'user', FILTER_VALIDATE_INT, array( 'options' => array( 'min_range' => 1 ) ) );
        if ( $user_id ) {
            // get user meta activation hash field
            $code = get_user_meta( $user_id, 'ssky_driver_verification_code', true );
            $is_verify = get_user_meta( $user_id, 'ssky_driver_verify_email', true );
            if ( $code == filter_input( INPUT_GET, 'key') && $is_verify == 'no'  ) {
                update_user_meta( $user_id, 'ssky_driver_verify_email', 'yes' );
                wc_add_notice('Email verification successfuly!', 'success');
            } else {
                wp_safe_redirect( wc_get_account_endpoint_url( 'my-account' ) );
            }
        }
    }
}


