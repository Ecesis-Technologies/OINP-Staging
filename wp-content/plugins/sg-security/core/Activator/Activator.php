<?php
namespace SG_Security\Activator;

use SG_Security\Activity_Log\Activity_Log_Helper;
use SG_Security\Htaccess_Service\Directory_Service;
use SG_Security\Htaccess_Service\Xmlrpc_Service;
use SG_Security\Install_Service\Install_Service;

/**
 * Class managing plugin activation.
 */
class Activator {

	/**
	 * Run on plugin activation.
	 *
	 * @since 1.0.0
	 */
	public function activate( $network_active ) {
		Activity_Log_Helper::create_log_tables();

		// Create the necesary tables in subsites upon activation for multisite.
		if (
			\is_multisite() &&
			true === $network_active
		) {
			// Get all sites.
			$sites = get_sites();

			// Loop trough subsites and create the necesary db tables.
			foreach ( $sites as $site ) {
				switch_to_blog( $site->blog_id );

				// Run the db creation.
				Activity_Log_Helper::create_log_tables();
			}

			// Restore to current blog.
			restore_current_blog();
		}

		// Check if system folder protection is enabled.
		if ( 1 === intval( get_option( 'sg_security_lock_system_folders', 0 ) ) ) {
			// Enable the existing rules on activation.
			$directory_service = new Directory_Service();
			$directory_service->toggle_rules( 1 );
		}

		// Check if we need to enable the xml-rpc.
		if ( 1 === intval( get_option( 'sg_security_disable_xml_rpc', 0 ) ) ) {
			$xml_rpc_service = new Xmlrpc_Service();

			// Enable the rule.
			$xml_rpc_service->toggle_rules( 1 );
		}

		$this->maybe_set_data_consent_default();

		$install_service = new Install_Service();
		$install_service->install();
	}

	/**
	 * Set the default data consent.
	 *
	 * @since 1.4.7
	 */
	public function maybe_set_data_consent_default() {
		// Check if we have a new installation and bail if we do not meet the new user criteria or the user has modified its consent settings.
		if ( ! empty( get_option( 'siteground_data_consent_timestamp', '' ) ) ) {
			return;
		}

		if ( '0.0.0' === get_option( 'sg_security_version', '0.0.0' ) ) {
			// Update the consent option.
			update_option( 'siteground_data_consent', 1 );
		}
	}
}
