<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://wpartisan.net/
 * @since      1.0.0
 *
 * @package    Remove_Add_To_Cart_Button_Woocommerce
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
$options = array(
	'ratcw_login_reg_page_url',
	'ratcw_login_reg_button_text',
	'ratcw_product_enquiry_email',
	'ratcw_disable_cart_page',
	'ratcw_disable_checkout_page',
	'ratcw_cart_checkout_redirect_url',
	'ratcw_add_to_cart_message_text_color',
	'ratcw_add_to_cart_message_background_color',
	'ratcw_price_message_text_color',
	'ratcw_price_message_background_color',
	'ratcw_product_ofs_message',
	'ratcw_product_obo_message',
);
foreach ( $options as $option_name ){
    delete_option( $option_name );
}

global $current_user;
$user_id = $current_user->ID;

delete_user_meta( $user_id, 'ratcw_igne_noti' );