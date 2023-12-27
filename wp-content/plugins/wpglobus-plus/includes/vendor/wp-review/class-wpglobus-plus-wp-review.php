<?php
/**
 * File: class-wpglobus-plus-wp-review.php
 *
 * @package WPGlobus Plus.
 *
 * @since 1.4.5
 */

if ( ! class_exists( 'WPGlobus_Plus_WP_Review' ) ) :
	
	class WPGlobus_Plus_WP_Review {

		/**
		 * @var object Instance of this class.
		 */
		protected static $instance;
	
		/**
		 * Meta for handling.
		 */	
		protected static $enabled_meta = array();
		
		/**
		 * Meta attrs tha contain multilingual value by default.
		 */
		protected static $default_attrs = array();
		
		/**
		 * Meta attrs that may contain multilingual value.
		 */
		protected static $meta_attrs = array();
		
		/**
		 * Contains meta values.
		 */
		protected static $meta = array();

		/**
		 * Constructor.
		 */
		protected function __construct() {

			/**
			 * Set meta for handling.
			 */
			self::$enabled_meta = array(
				# `Review` metabox.
				'wp_review_schema_options'
			);	
			
			/**
			 * Set default meta attrs that may contain multilingual value.
			 */
			self::$default_attrs = array(
				'wp_review_schema_options' => array(
					'name',
					'description',
					'more_text',
					'url',
				)
			);

			if ( is_admin() ) {
				
				add_filter( 'wpglobus_plus_ml_elements', array( __CLASS__, 'filter__wpglobus_plus_ml_elements' ), 5, 2 );
				add_filter( 'wpglobus_config_vendors', array( __CLASS__, 'filter__config_vendors' ), 5, 2);
				
				add_filter( 'get_post_metadata', array( __CLASS__, 'filter__get_metadata' ), 5, 4 );
				add_action( 'update_post_meta',  array( __CLASS__, 'on__update_post_meta' ), 5, 4 );
				add_action( 'updated_post_meta', array( __CLASS__, 'on__updated_post_meta' ), 5, 4 );
				
			} else {
				
				add_filter( 'wpglobus_multilingual_meta_keys', array( __CLASS__, 'filter__multilingual_meta_keys' ), 5 );

			}
		}

		/**
		 * Get instance of this class.
		 *
		 * @return WPGlobus_Plus_WP_Review
		 */
		public static function get_instance() {
			if ( ! ( self::$instance instanceof WPGlobus_Plus_WP_Review ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		
		/**
		 * Filter meta data.
		 * @scope admin
		 */
		public static function filter__get_metadata( $check, $object_id, $meta_key, $single ) {
			
			if ( ! in_array( $meta_key, self::$enabled_meta ) ) {
				return $check;
			}
				
			if ( ! WPGlobus::Config()->builder->is_builder_page() ) {
				/**
				 * Prevent update post meta when builder is not set.
				 */
				return $check;
			}

			$language = WPGlobus::Config()->builder->get_language();

			$meta_type = 'post';

			$meta_cache = wp_cache_get( $object_id, $meta_type . '_meta' );
			
			if ( ! empty( $meta_cache[ $meta_key ][0] ) ) {

				/**
				 * Option contains array schema_item=>attrs, for example
				 *    [Game] => Array
				 *		(
				 *			[name] => {:en}Rabbit Hole Riches{:}{:ru}Богатство кроличьей норы{:}
				 *			[description] => {:en}Rabbit Hole Riches game description{:}{:ru}Описание игры Богатство кроличьей норы{:}
				 *			[image] => Array
				 *				(
				 *					[id] => 
				 *					[url] => 
				 *				)
				 *
				 *			[more_text] => {:en}[ More ]{:}{:ru}[ Ещё ]{:}
				 *			[url] => {:en}https://site/{:}{:ru}https://site/ru/{:}
				 *			[use_button_style] => 0
				 *			[author] => 
				 *		)
				 */				
				$option = maybe_unserialize( $meta_cache[ $meta_key ][0] );
				
				/**
				 * Get attributes that may contain multilingual values.
				 */
				$meta_attrs = self::get_meta_attrs( $meta_key );

				if ( ! empty( $meta_attrs ) ) {
					
					foreach( $option as $key=>$attr ) {
						foreach( $meta_attrs as $_attr ) {
							if ( ! empty( $option[ $key ][ $_attr ] ) ) {
								$option[ $key ][ $_attr ] = WPGlobus_Core::text_filter( $option[ $key ][ $_attr ], $language, WPGlobus::RETURN_EMPTY );
							}
						}
					}

					$meta_cache[ $meta_key ][0] = maybe_serialize( $option );
					
					wp_cache_replace( $object_id, $meta_cache, $meta_type . '_meta' );
				}
			}

			return $check;
		}			
		
		/**
		 * Fires immediately before updating metadata.
		 */
		public static function on__update_post_meta( $meta_id, $object_id, $meta_key, $meta_value ){
			
			if ( ! in_array( $meta_key, self::$enabled_meta ) ) {
				return;
			}
			
			if ( ! WPGlobus::Config()->builder->is_builder_page() ) {
				/**
				 * Prevent update post meta when builder is not set.
				 */
				return;
			}
			
			global $wpdb;
	
			foreach( self::$enabled_meta as $meta ) {
				$_meta_value = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = %s", $meta) );
				self::$meta[ $meta ] = maybe_unserialize( $_meta_value );
			}
		}
		
		/**
		 * Fires immediately after updating metadata.
		 */
		public static function on__updated_post_meta( $meta_id, $object_id, $meta_key, $meta_value ){
			
			if ( ! in_array( $meta_key, self::$enabled_meta ) ) {
				return;
			}
			
			if ( ! WPGlobus::Config()->builder->is_builder_page() ) {
				/**
				 * Prevent update post meta when builder is not set.
				 */
				return;
			}
			
			global $wpdb;

			$table = _get_meta_table( 'post' );
			if ( ! $table ) {
				return false;
			}
			
			$language = WPGlobus::Config()->builder->get_language();

			/** 
			 * $meta_value contains new value.
			 */
			if ( is_array( $meta_value ) ) {
			
				/**
				 * Get attributes that may contain multilingual values.
				 */
				$meta_attrs = self::get_meta_attrs( $meta_key );
				
				foreach( $meta_value as $meta_value_key=>$meta_value_attrs ) {

					foreach( $meta_value_attrs as $_attr=>$_value ) {
						
						if ( ! in_array( $_attr, $meta_attrs ) ) {
							continue;
						}
						
						$_old_value = self::$meta[ $meta_key ][ $meta_value_key ][ $_attr ];
						
						$tr = array();
						
						if ( ! empty( $_old_value ) ) {
						
							foreach( WPGlobus::Config()->enabled_languages as $_lang ) {
								$_v = WPGlobus_Core::text_filter( $_old_value, $_lang, WPGlobus::RETURN_EMPTY );
								if ( ! empty( $_v ) ) {
									$tr[$_lang] = $_v;
								}
							}
							
						}
						
						if ( ! empty( $_value ) ) {
							$tr[$language] = $_value;
						}
						
						if ( empty( $tr ) ) {
							$new_value = '';
						} else {
							$new_value = WPGlobus_Utils::build_multilingual_string( $tr );
						}

						$meta_value[ $meta_value_key ][ $_attr ] = $new_value;
					}
				}
			}
		
			/**
			 * For testing. 
			 * Output to log here >> self::$meta[ $meta_key ] and $meta_value.
			 */
			// $__test_key = 'Book'; 
			// error_log( print_r( self::$meta[ $meta_key ][$__test_key], true ) );
			// error_log( print_r( $meta_value[$__test_key], true ) );

			$meta_value  = maybe_serialize( $meta_value );
	
			$data  = compact( 'meta_value' );
			$where = array(
				'post_id'  => $object_id,
				'meta_key' => $meta_key,
			);			

			$result = $wpdb->update( $table, $data, $where );
			if ( ! $result ) {
				return false;
			}

			/**
			 * May be we need to delete cache.
			 */
			// wp_cache_delete( $object_id, $meta_type . '_meta' );
			
			return true;
		}
		
		/**
		 * Filter  to set multilingual fields in Standard mode.
		 *
		 * @since 1.4.5
		 */		
		public static function filter__wpglobus_plus_ml_elements( $elements, $pages ){
			
			if ( WPGlobus::Config()->builder->is_builder_page() ) {
				return;
			}
			
			# `Review` metabox
			$elements[] = 'wp_review_heading';
			
			# `Review Description` metabox
			$elements[] = 'wp_review_desc_title';
			// $elements[] = 'wp_review_desc'; This wysiwyg field doesn't work with `tinymce` module.

			$elements = array_merge(
				$elements,
				self::get_ml_elements(false) 
			);

			return $elements;
		}
		
		/**
		 * Filter  to set multilingual fields in Builder mode.
		 *
		 * @since 1.4.5
		 */
		public static function filter__config_vendors( $config, $builder ){

			if ( ! $builder->is_builder_page() ) {
				return $config;
			}
	
			$_post_ml_fields = array(
				# `Review` metabox
				'wp_review_heading' => array(),
				# `Review Description` metabox
				'wp_review_desc_title' => array(),
				'wp_review_desc' => array(),
			);
			
			$_extra_ml_fields = self::get_ml_elements( $builder->is_builder_page() );
			if ( ! empty( $_extra_ml_fields ) ) {
				$_post_ml_fields = array_merge( 
					$_post_ml_fields,
					$_extra_ml_fields
				);
			}
			
			$config['wp-review'] = array(
				'post_meta_fields' => array(
					# `Review` metabox
					'wp_review_heading' => array(),
					# `Review Description` metabox
					'wp_review_desc_title' => array(), 	
					'wp_review_desc' => array(),
					# Don't add here meta like `wp_review_schema_options`
				),
				'post_ml_fields' => $_post_ml_fields
			);

			return $config;
		}
		
		/**
		 * Get meta attrs that may contain multilingual value.
		 */
		public static function get_meta_attrs( $meta_key = '' ){
			
			if ( empty( $meta_key ) ) {
				return false;
			}
			
			if ( ! isset( self::$meta_attrs[ $meta_key ] ) ) {
				if ( empty( self::$default_attrs[ $meta_key ] ) ) {
					self::$meta_attrs[ $meta_key ] = array();
				} else {
					self::$meta_attrs[ $meta_key ] = self::$default_attrs[ $meta_key ];
				}
			}
			
			return self::$meta_attrs[ $meta_key ];
		}
		
		/**
		 *
		 */
		public static function get_ml_elements( $is_builder = true ) {

			static $ml_elements = null;
			if ( ! is_null( $ml_elements ) ) {
				return $ml_elements;
			}

			$schema_items = self::get_review_schema_items();
			
			$ml_elements = array();
			
			foreach( self::$enabled_meta as $enabled_meta ) {
				
				switch ( $enabled_meta ) {
					case '__SOME_ANOTHER_META__':
						// do something
						break;
					default:

						$meta_attrs = self::get_meta_attrs( $enabled_meta );

						foreach( $schema_items as $schema_item ) {
							foreach( $meta_attrs as $meta_attr ) {
								if ( $is_builder ) {
									$ml_elements[ "{$enabled_meta}[{$schema_item}][{$meta_attr}]" ] = array();
								} else {
									$ml_elements[] = "{$enabled_meta}[{$schema_item}][{$meta_attr}]";
								}
							}
						}						
						break;
				}
			
			}
			
			return $ml_elements;
		}

		/**
		 * Specify meta keys where the meta data can be multilingual.
		 *
		 * @scope front
		 */		
		public static function filter__multilingual_meta_keys( $multilingual_meta_keys ) {
			
			/**
			 * @see fields in `filter__config_vendors` function.
			 */
			
			# `Review` metabox.
			$multilingual_meta_keys[ 'wp_review_heading' ] = true;
			$multilingual_meta_keys[ 'wp_review_schema_options' ] = true;
			
			# `Review Description` metabox.
			$multilingual_meta_keys[ 'wp_review_desc_title' ] = true;
			$multilingual_meta_keys[ 'wp_review_desc' ] = true;
			
			return $multilingual_meta_keys;
		}	
	
		/**
		 * Get review schema items.
		 */
		public static function get_review_schema_items() {
			
			static $schema_items = null;
			
			if ( ! is_null( $schema_items ) ) {
				return $schema_items;
			}
			
			/**
			 * @see using `wp_review_schema_types` wp-review\admin\review-options-meta-box.php
			 */				
			if ( false && function_exists( 'wp_review_schema_types' ) ) {
				/**
				 * Function `wp_review_schema_types` is not accesible in Builder mode.
				 */
			} else {

				$schema_items = array(
					'Book',
					'Course',
					'CreativeWorkSeason',
					'CreativeWorkSeries',
					'Episode',
					'Event',
					'Game',
					'Hotel',
					'LocalBusiness',
					'Movie',
					'MusicPlaylist',
					'MusicRecording',
					'Organization',
					'Product',
					'Recipe',
					'Restaurant',
					'SoftwareApplication',
					'Store',
					'TVSeries',
				);
			}

			return $schema_items;	
		}

	} // class WPGlobus_Plus_WP_Review.
	
endif;

# --- EOF