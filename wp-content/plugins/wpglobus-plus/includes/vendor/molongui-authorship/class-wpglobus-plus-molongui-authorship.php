<?php
/**
 * File: class-wpglobus-plus-molongui-authorship.php
 *
 * @package WPGlobus-Plus.
 *
 * @since 1.4.0
 */

if ( ! class_exists( 'WPGlobus_Plus_Molongui_Authorship' ) ) { 
	
	class WPGlobus_Plus_Molongui_Authorship {

		/**
		 * @var object Instance of this class.
		 */
		protected static $instance;

		/**
		 * Constructor.
		 */
		protected function __construct() {
			
			if ( ! is_admin() ) {
				add_filter( 'option_molongui_authorship_box', array( __CLASS__, 'filter__molongui_authorship_box' ), 5, 2 );
			}
			
			/**
			 * @see molongui-authorship\includes\class-author.php
			 */
			add_filter( 'authorship/author/posts', array( __CLASS__, 'filter__get_posts' ), 5, 5 );	
		
			/**
			 * @see molongui-authorship\includes\class-author.php
			 */
			add_filter( 'authorship/author/get', array( __CLASS__, 'filter__get_author' ), 5, 3 );			

			/**
			 * @see molongui-authorship\public\views\parts\html-author-box-bio.php
			 */
			add_filter( 'authorship/front/author/bio', array( __CLASS__, 'filter__author_bio' ) );

			/**
			 * @see "get_{$meta_type}_metadata" in c:\var\htdocs\www.dev-wpg.com\wp-includes\meta.php
			 */
			// add_filter( 'get_post_metadata', array( __CLASS__, 'filter__user_metadata' ), 5, 5 ); 
			add_filter( 'get_user_metadata', array( __CLASS__, 'filter__user_metadata'), 5, 4 );

			/**
			 * @see molongui-authorship\includes\class-author.php
			 * @W.I.P. @since 1.4.0
			 */
			//add_filter( 'molongui_authorship_get_author_meta', 'filter__author_meta', 5, 4 );
		}

		/**
		 * Get instance of this class.
		 *
		 * @return WPGlobus_Plus_Molongui_Authorship
		 */
		public static function get_instance() {
			if ( ! ( self::$instance instanceof WPGlobus_Plus_Molongui_Authorship ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		
		/**
		 * @since 1.8.4
		 */
		public static function filter__molongui_authorship_box( $value, $option ) {
			
			if ( is_array($value) ) {
				
				foreach( $value as $_key=>$_value ) {

					if ( empty( $_value ) ) {
						continue;
					}

					/**
					 * Exclude from translation the object.
					 */
					if ( is_object( $_value ) ) {
						continue;
					}

					if ( is_array($_value) ) {
						$value[$_key] = self::filter__molongui_authorship_box( $value, $option );
					} else {
						if ( WPGlobus_Core::has_translations( $_value ) ) {
							$value[$_key] = WPGlobus_Core::text_filter( $_value, WPGlobus::Config()->language );
						}
					}
				}				
			} else if ( is_string($value) && WPGlobus_Core::has_translations($value) ) {
				$value = WPGlobus_Core::text_filter( $value, WPGlobus::Config()->language );
			}
			
			return $value;
		}
		
		/**
		 * @since 1.4.0
		 */
		public static function filter__get_posts( $posts, $id, $type, $author, $parsed_args ) {
			foreach( $posts as $_id=>$post ) {
				WPGlobus_Core::translate_wp_post( $posts[$_id], WPGlobus::Config()->language );
			}
			return $posts;
		}
		
		/**
		 * @since 1.4.0
		 */
		public static function filter__get_author( $author, $id, $type ) {
			
			if ( ! ( $author instanceof WP_User ) ) {
				return $author;
			}
			
			if ( ! is_object( $author->data ) ) {
				return $author;
			}

			if ( WPGlobus_Core::has_translations( $author->data->display_name ) ) {
				$display_name = trim( WPGlobus_Core::extract_text( $author->data->display_name, WPGlobus::Config()->language ) );
				if ( empty( $display_name ) ) {
					$display_name = WPGlobus_Core::extract_text( $author->data->display_name, WPGlobus::Config()->default_language );
				}
				$author->data->display_name = $display_name;
			}
			
			return $author;
		}
	
		/**
		 * @since 1.4.0
		 */
		public static function filter__author_bio( $author_bio ) {
			if ( WPGlobus_Core::has_translations( $author_bio ) ) {
				$author_bio = WPGlobus_Core::extract_text( $author_bio, WPGlobus::Config()->language );
			}
			return $author_bio;
		}
		
		/**
		 * @since 1.4.0
		 */
		public static function filter__user_metadata( $result, $object_id, $meta_key, $single ) {
			
			if ( is_admin() ) {
				return $result;
			}
				
			if ( defined( 'WPGlobus::WP_USER_EDIT_PAGE' ) ) {
				$_wp_user_edit_page = WPGlobus::WP_USER_EDIT_PAGE;	
			} else {
				$_wp_user_edit_page = 'user-edit.php';	
			}
			
			static $_meta_keys = null;
			
			if ( is_null( $_meta_keys ) ) {

				$_options = get_option('wpglobus_plus_wpglobeditor');

				if ( empty( $_options ) || empty( $_options['page_list'][$_wp_user_edit_page] ) ) {
					return $result;
				}
				
				$_meta_keys = $_options['page_list'][$_wp_user_edit_page];
			}

			if ( in_array( $meta_key, $_meta_keys ) ) {
				
				$meta_type = 'user';
				
				$meta_cache = wp_cache_get( $object_id, $meta_type . '_meta' );

				if ( ! $meta_cache ) {
					$meta_cache = update_meta_cache( $meta_type, array( $object_id ) );
					if ( isset( $meta_cache[ $object_id ] ) ) {
						$meta_cache = $meta_cache[ $object_id ];
					} else {
						$meta_cache = null;
					}
				}	
				
				if ( ! is_null( $meta_cache ) && ! empty( $meta_cache[$meta_key][0] ) ) {
					if ( WPGlobus_Core::has_translations( $meta_cache[$meta_key][0] ) ) {
						$result = trim( WPGlobus_Core::extract_text( $meta_cache[$meta_key][0], WPGlobus::Config()->language ) );
						if ( empty( $result ) ) {
							$result = WPGlobus_Core::extract_text( $meta_cache[$meta_key][0], WPGlobus::Config()->default_language );
						}
					}
				}
			}
			
			return $result;
		}
		
		/**
		 * @W.I.P. @since 1.4.0
		 */
		/* 
		function filter__author_meta( $meta, $id, $type, $key ) {
			return $meta;
		} 
		// */
	}
}

# --- EOF