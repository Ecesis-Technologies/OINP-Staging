<?php
/**
 * File: class-wpglobus-plus-wpdiscuz.php
 *
 * @package WPGlobus-Plus.
 *
 * @since 1.4.1
 */

if ( ! class_exists( 'WPGlobus_Plus_wpDiscuz' ) ) { 
	
	class WPGlobus_Plus_wpDiscuz {

		/**
		 * @var object Instance of this class.
		 */
		protected static $instance;

		/**
		 * Constructor.
		 */
		protected function __construct() {
			
			/**
			 * @see wpdiscuz\themes\default\class.WpdiscuzWalker.php
			 */
			add_filter( 'wpdiscuz_comment_end', array( __CLASS__, 'filter__wpdiscuz_comment_end' ), 5, 4 );	

			/**
			 * @see wpdiscuz\themes\default\comment-form.php
			 */
			add_filter( 'wpdiscuz_user_info_and_logout_link', array( __CLASS__, 'filter__wpdiscuz_user_info_and_logout_link' ), 5 );
			
			/**
			 * @see wpdiscuz\themes\default\class.WpdiscuzWalker.php
			 * @W.I.P. @since 1.4.1
			 */
			// add_filter( 'wpdiscuz_comment_author', 'filter__wpdiscuz_comment_author', 5, 2 );
		}

		/**
		 * Get instance of this class.
		 *
		 * @return WPGlobus_Plus_wpDiscuz
		 */
		public static function get_instance() {
			if ( ! ( self::$instance instanceof WPGlobus_Plus_wpDiscuz ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		
		/**
		 * @since 1.4.1
		 */
		public static function filter__wpdiscuz_comment_end( $commentOutput, $comment, $depth, $args ) {
			if ( WPGlobus_Core::has_translations( $commentOutput ) ) {
				$commentOutput = WPGlobus_Core::extract_text( $commentOutput, WPGlobus::Config()->language );
			}		
			return $commentOutput;
		}
		
		/**
		 * @since 1.4.1
		 */
		public static function filter__wpdiscuz_user_info_and_logout_link( $logout_text ) {
			if ( WPGlobus_Core::has_translations( $logout_text ) ) {
				$logout_text = WPGlobus_Core::extract_text( $logout_text, WPGlobus::Config()->language );
			}		
			return $logout_text;
		}
	
		/**
		 * @W.I.P. @since 1.4.1
		 */
		/** 
		function filter__wpdiscuz_comment_author( $author_name, $comment ) {
			if ( WPGlobus_Core::has_translations( $author_name ) ) {
				$author_name = WPGlobus_Core::extract_text( $author_name, WPGlobus::Config()->language );
			}	
			return $author_name;
		}
		// */
	}
}

# --- EOF