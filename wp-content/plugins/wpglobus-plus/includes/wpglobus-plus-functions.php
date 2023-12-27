<?php
/**
 * File: wpglobus-plus-functions.php
 *
 * @package WPGlobus-Plus.
 *
 * @since 1.4.0
 */

if ( class_exists( 'MolonguiAuthorship' ) || defined( 'MOLONGUI_AUTHORSHIP_VERSION' ) ) {
	/**
	 * https://wordpress.org/plugins/molongui-authorship/
	 * @since 1.4.0
	 */
	require_once dirname( __FILE__ ) . '/vendor/molongui-authorship/class-wpglobus-plus-molongui-authorship.php';
	WPGlobus_Plus_Molongui_Authorship::get_instance();
}

if ( defined( 'WPDISCUZ_DIR_PATH' ) ) {
	/**
	 * https://wordpress.org/plugins/wpdiscuz/
	 * @since 1.4.1
	 */
	require_once dirname( __FILE__ ) . '/vendor/wpdiscuz/class-wpglobus-plus-wpdiscuz.php';
	WPGlobus_Plus_wpDiscuz::get_instance();	
}

if ( defined( 'WP_REVIEW_PLUGIN_VERSION' ) ) {
	/**
	 * https://wordpress.org/plugins/wp-review/
	 * @since 1.4.5
	 */
	require_once dirname( __FILE__ ) . '/vendor/wp-review/class-wpglobus-plus-wp-review.php';
	WPGlobus_Plus_WP_Review::get_instance();		
}

# --- EOF