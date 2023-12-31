<?php
/**
 * File: class-wpglobus-wp_options.php
 *
 * @package WPGlobus\WP_Options
 * Author  Alex Gor(alexgff)
 */

/**
 * Class WPGlobus_WP_Options.
 * To filter the options from `wp_options` table.
 */
if ( ! class_exists( 'WPGlobus_WP_Options' ) ) :

	class WPGlobus_WP_Options {

		/**
		 * Instance of this class.
		 *
		 * @var WPGlobus_WP_Options
		 */
		protected static $instance;

		/**
		 * Constructor.
		 *
		 * @param string[] $wp_options
		 */
		protected function __construct( $wp_options = array() ) {

			if ( empty( $wp_options ) || ! is_array( $wp_options ) ) {
				return;
			}

			if ( is_admin() ) {
				foreach ( $wp_options as $option ) {
					if ( ! empty( $option ) ) {
						if ( is_string( $option ) ) {
							add_filter( 'option_' . $option, array( __CLASS__, 'filter__translate_option' ) );
							// } else {
							// @since 2.6.1 @W.I.P Case for array.
						}
					}
				}
			}
		}

		/**
		 * Get instance of this class.
		 *
		 * @param string[] $wp_options
		 *
		 * @return WPGlobus_WP_Options
		 */
		public static function get_instance( $wp_options ) {
			if ( ! ( self::$instance instanceof WPGlobus_WP_Options ) ) {
				self::$instance = new self( $wp_options );
			}

			return self::$instance;
		}

		/**
		 * Callback to translate option.
		 *
		 * @param string $option
		 *
		 * @return string
		 */
		public static function filter__translate_option( $option ) {
			if ( ! is_string( $option ) ) {
				return $option;
			}

			if ( ! WPGlobus::Config()->builder->is_running() ) {
				return $option;
			}

			$language = WPGlobus::Config()->builder->get_language();
			if ( ! empty( $language ) ) {
				$option = WPGlobus_Core::text_filter( $option, $language );
			}

			return $option;
		}
	}

endif;
