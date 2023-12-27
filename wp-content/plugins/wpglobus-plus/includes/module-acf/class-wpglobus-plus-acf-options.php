<?php
/**
 * File: class-wpglobus-plus-acf-options.php
 *
 * Class WPGlobusPlus_Acf_Options
 * @since 1.7.2
 */

if ( ! class_exists( 'WPGlobusPlus_Acf_Options' ) ) :

	class WPGlobusPlus_Acf_Options {
		
		/**
		 * Multilingual field name.
		 * @see wpglobus\includes\vendor\acf\class-wpglobus-vendor-acf.php
		 */
		const MULTILINGUAL_FIELD_NAME = 'wpglobus_multilingual_field';

		/**
		 *
		 */
		protected static $run = true;
		
		/**
		 * Prefix for acf fields.
		 */		
		protected static $field_prefix = '';
		
		/**
		 * ACF version.
		 */
		protected static $acf_pro_version = null;
		
		/**
		 * All options pages settings.
		 */
		protected static $acf_options_pages = null;
		
		/**
		 * Fields of single option.
		 */
		protected static $option_fields = null;

		/**
		 * Multilingual fields of single option for localize in JS.
		 */		
		protected static $option_ml_fields = null;
		
		/**
		 * Post type of field group.
		 */
		protected static $field_group_post_type = 'acf-field-group';
		
		/**
		 * Post type of field.
		 */		
		protected static $field_post_type = 'acf-field';
		
		/**
		 * Module option key.
		 */
		protected static $module_option_key = 'wpglobus_plus_acf';
		
		/**
		 * Incoming arguments.
		 */
		protected static $args = array();

		/**
		 * @var object Instance of this class.
		 */
		protected static $instance;
		
		/**
		 * Constructor.
		 */
		protected function __construct( $args = array() ) {

			self::$acf_pro_version = acf()->version;

			if ( is_admin() ) {

				add_action( 'init', array( __CLASS__, 'on__init' ) );
				
				if ( ! self::$run ) {
					return;
				}
				
				/**
				 * @since 1.8.0 
				 * @see advanced-custom-fields-pro\includes\acf-field-functions.php
				 */
				add_filter( 'acf/pre_render_fields', array( __CLASS__, 'filter__pre_render_fields' ), 5, 2 );
				
				/**
				 * @since 1.8.0 
				 * @see advanced-custom-fields-pro\includes\acf-field-group-functions.php
				 */				
				add_filter( 'acf/load_field_groups', array( __CLASS__, 'filter__load_field_groups' ), 5 );
				
				
				add_filter( 'wpglobus_enabled_pages', array( __CLASS__, 'filter__enable_pages' ) );
				add_action( 'admin_print_scripts', array(__CLASS__, 'on__admin_scripts' ) );
				
				add_action(
					'wp_insert_post',
					array(
						__CLASS__,
						'on__wp_insert_post'
					), 5, 3
				);
				
			} else {
				
				// Frontend.
				
				/**
				 * Fixed PHP Warning with empty options array.
				 * @since 1.8.0
				 */
				$opt = get_option( self::$module_option_key );
				if ( ! empty( $opt['options'] ) && is_array($opt['options']) ) {
					foreach( $opt['options'] as $_option ) {
						add_filter( 'option'.$_option,  array(__CLASS__, 'filter__option' ), 5, 2 );
					}
				}
			}
		}
		
		/**
		 * Get instance of this class.
		 *
		 * @return WPGlobusPlus_Acf_Options || void
		 */
		public static function get_instance( $args = array() ) {
			
            if ( ! defined('ACF_PRO') ) {
				return;
			}

			/**
			 * Removed code to prevent duplication with `on__init` function.
			 * @since 1.7.4
			 */
			// if ( is_admin() ) {
				// if ( ! WPGlobus_WP::is_pagenow( array('admin.php', 'post.php') ) ) {
					// return;
				// }
			// }

			if ( ! ( self::$instance instanceof WPGlobusPlus_Acf_Options  ) ) {
				self::$instance = new self( $args );
			}

			return self::$instance;
		}
		
		/**
		 * Filter for option.
		 */
		public static function filter__option( $value, $option ) {
			
			if ( empty( $value ) ) {
				return $value;
			}
			
			if ( ! WPGlobus_Core::has_translations($value) ) {
				return $value;
			}
		
			$value = WPGlobus_Core::text_filter( $value, WPGlobus::Config()->language );

			return $value;
		}
		
		/**
		 * Init of options after saving Field group.
		 */
		protected static function init_option() {
			
			global $wpdb;
			
			$search_string = '"wpglobus_multilingual_field";i:1';
			
			$result = $wpdb->get_results( 
				"SELECT post_name, ID FROM {$wpdb->prefix}posts WHERE post_content LIKE '%{$search_string}%'",
				OBJECT_K 
			);


			if ( ! empty($result) ) {
				
				$field_names = array();
				
				foreach( $result as $field_name=>$data ) {
					$field_names[] = "'" . $field_name . "'";
				}
				
				$_field_names = implode( ',', $field_names );
				
				$result = $wpdb->get_results( 
					"SELECT option_name FROM {$wpdb->prefix}options WHERE option_value IN ($_field_names)",
					OBJECT_K 
				);					
				
				if ( empty( $result ) ) {
					$opt['options'] = '';
				} else {	
					$opt['options'] = array_keys($result);
				}
				
				update_option( self::get_module_option_key(), $opt, false );
			}
		}
		
		/**
		 * Init action.
		 */
		public static function on__init() {
			
			$required_functions = array(
				'acf_get_options_pages',
				'acf_get_field_groups',
				'acf_get_fields'
			);
			
			$_init = true;
			foreach( $required_functions as $function ) {
				if ( ! function_exists($function) ) {
					$_init = false;
					break;
				}
			}
			
			if ( ! $_init ) {
				self::$run = false;
				return;
			}
			
			/**
			 * @see acf_get_options_pages() in advanced-custom-fields-pro\pro\options-page.php
			 */
			$options_pages = acf_get_options_pages();
			
			if ( ! empty($options_pages) && is_array( $options_pages ) ) {
				self::$acf_options_pages = array();
				foreach( $options_pages as $_key=>$options_page ) {
					self::$acf_options_pages[] = $_key;
				}
			} else {
				self::$run = false;
				return;
			}
			
			if ( empty( $_GET['page'] ) ) {
				self::$run = false;
				return;
			}
			
			$page = WPGlobus_Utils::safe_get('page');

			if ( ! in_array( $page, self::get_acf_options_pages() ) ) {
				self::$run = false;
				return;
			}
			
			// get field groups.
			$field_groups = acf_get_field_groups(array(
				'options_page' => $page
			));

			if ( empty($field_groups) ) {
				self::$run = false;
				return;
			}
			
			self::$option_fields = array();
			foreach( $field_groups as $field_group ) {
				// load fields.
				$_fields = acf_get_fields( $field_group );
				if ( ! empty( $_fields ) ) {
					self::$option_fields = array_merge( self::$option_fields, $_fields );
				}
			}

			if ( empty( self::$option_fields ) ) {
				self::$run = false;
				return;				
			}
			
			self::set_field_prefix();
		}

		/**
		 * Get arg.
		 */		
		public static function get_arg($arg) {
			
			if ( ! isset( self::$args[$arg] ) ) {
				return null;
			}
			
			return self::$args[$arg];
		}
		
		/**
		 * Enable pages for loading WPGlobus scripts/styles.
		 */
		public static function filter__enable_pages($pages) {
			$options_pages = self::get_acf_options_pages();
			if ( $options_pages ) {
				$pages = array_merge( $pages, $options_pages );
			}
			return $pages;
		}
		
		/**
		 * Get field id.
		 */
		public static function get_field_id( $field ) {
			return self::get_field_prefix() . $field['key'];
		}

		/**
		 * Set field prefix.
		 */		
		public static function set_field_prefix() {
			if ( empty(self::$field_prefix) ) {
				if ( is_array( self::$option_fields[0] ) && ! empty( self::$option_fields[0]['prefix'] ) ) {
					self::$field_prefix = self::$option_fields[0]['prefix'] . '-';
				}
			}
		}

		/**
		 * Get field prefix.
		 */		
		public static function get_field_prefix() {
			return self::$field_prefix;
		}
		
		/**
		 * Get option's multilingual fields.
		 */
		public static function get_option_ml_fields() {
			
			if ( empty( self::$option_fields ) ) {
				return false;
			}
			
			if ( ! is_null(self::$option_ml_fields) ) {
				return self::$option_ml_fields;
			}
		
			self::$option_ml_fields = self::_get_option_fields( self::$option_fields );
			
			return self::$option_ml_fields;
		}
		
		/**
		 * @since 1.8.0
		 */
		protected static function _get_option_fields( $option_fields, $parent_field = false ) {
			
			$fields = array();
			
			$parent = false;
			if ( $parent_field ) {
				$parent['ID']   = isset($parent_field['ID']) ? $parent_field['ID'] : false;
				$parent['type'] = isset($parent_field['type']) ? $parent_field['type'] : false;
				$parent['key']  = isset($parent_field['key']) ? $parent_field['key'] : false;
			}
			
			foreach( $option_fields as $field ) {
				
				if ( ! empty( $field[ self::MULTILINGUAL_FIELD_NAME ] ) && $field[ self::MULTILINGUAL_FIELD_NAME ] ) {
					$fields[ self::get_field_id( $field ) ] = array(
						'ID'     => $field['ID'],
						'parent' => $parent,
						'type' 	 => $field['type'],
						'name'   => $field['name'],
						'key'    => $field['key'],
						'label'  => WPGlobus_Core::text_filter( $field['label'], WPGlobus::Config()->language ),
						'labelSource' => $field['label'],
					);
				}
				
				if ( ! empty($field['sub_fields']) && is_array($field['sub_fields']) ) {
					$_fields = self::_get_option_fields( $field['sub_fields'], $field );
					if ( ! empty($_fields) ) {
						foreach( $_fields as $_key=>$_field ) {
							$fields[$_key] = $_field ;
						}
					}
				}
				
			}
			
			return $fields;
		}
		
		/**
		 * Admin print scripts.
		 *
		 * @return void
		 */
		public static function on__admin_scripts() {
			
			$page = WPGlobus_Utils::safe_get('page');

			if ( ! in_array( $page, (array) self::get_acf_options_pages() ) ) {
				return;
			}
			
			$option_ml_fields = self::get_option_ml_fields();
			
			$data = array(
				'translatableClass' => 'wpglobus-translatable',
				'fieldPrefix'		=> self::get_field_prefix(),
				'optionMlFields' 	=> $option_ml_fields,
				'language'			=> WPGlobus::Config()->language
			);
			
			wp_register_script(
				'wpglobus-plus-acf-options',
				WPGlobusPlus_Asset::url_js( 'wpglobus-plus-acf-options' ),
				array( 'jquery' ),
				WPGLOBUS_PLUS_VERSION,
				true
			);
			wp_enqueue_script( 'wpglobus-plus-acf-options' );
			wp_localize_script(
				'wpglobus-plus-acf-options',
				'WPGlobusPlusAcfOptions',
				array(
					'wpglobus_plus_version' => WPGLOBUS_PLUS_VERSION,
					'data' => $data
				)
			);

			if ( self::has_wysiwyg_field() ) {
				if ( file_exists( WPGlobusPlus::$PLUGIN_DIR_PATH . 'vendor/multilingual-wysiwyg/multilingual-wysiwyg.php' ) ) {
					require_once WPGlobusPlus::$PLUGIN_DIR_PATH . 'vendor/multilingual-wysiwyg/multilingual-wysiwyg.php';
					if ( class_exists( 'Multilingual_WYSIWYG' ) ) {
						Multilingual_WYSIWYG::construct(
							array(
								'provider' 	  	 => 'WPGlobus',
								'editor_id'   	 => 'acf-editor-*', // All ACF editors on page.
								'submit_element' => '#publish',
								#'enabled_pages'  => any page,
							)
						);
					}
				}					
			}
		}

		/**
		 * Callback for `wp_insert_post` action.
		 *
		 * @return array
		 */
		public static function on__wp_insert_post( $post_ID, $post, $update ) {
			
			if ( self::$field_group_post_type != $post->post_type ) {
				return;
			}
			
			self::init_option();
		}

		/**
		 * Check out for existence the wysiwyg field.
		 */
		protected static function has_wysiwyg_field() {
			
			static $_has_wysiwyg_field = null;

			if ( ! is_null( $_has_wysiwyg_field ) ) {
				return $_has_wysiwyg_field;
			}
			
			$_has_wysiwyg_field = false;

			if ( empty( self::get_option_ml_fields() ) ) {
				return $_has_wysiwyg_field;	
			}
			
			foreach( self::get_option_ml_fields() as $id=>$data ) {
				if ( 'wysiwyg' == $data['type'] ) {
					$_has_wysiwyg_field = true;
					break;
				}					
			}

			return $_has_wysiwyg_field;
		}
		
		/**
		 * Get all options pages settings.
		 */
		protected static function get_acf_options_pages() {
			if ( is_null( self::$acf_options_pages ) ) {
				return false;
			}
			return self::$acf_options_pages;
		}

		/**
		 * Get module option key.
		 */		
		public static function get_module_option_key() {
			return self::$module_option_key;
		}
	
		/**
		 * @since 1.8.0
		 */	
		public static function filter__pre_render_fields( $fields, $post_id ) {
	
			if ( ! is_array($fields) || empty($fields) ) {
				return $fields;
			}

			$options = array( 'label', 'instructions', 'button_label' );

			foreach( $fields as $_key=>$_field ) {
				foreach( $options as $_option ) {
					if ( ! empty($_field[$_option]) && WPGlobus_Core::has_translations( $_field[$_option] ) ) {
						$fields[$_key][$_option] = WPGlobus_Core::text_filter( $_field[$_option], WPGlobus::Config()->language );
					}					
				}
				
				if ( ! empty($_field['sub_fields']) && is_array($_field['sub_fields']) ) {
					$fields[$_key]['sub_fields'] = self::filter__pre_render_fields( $_field['sub_fields'], $post_id );
				}
			}

			return $fields;
		}
		
		/**
		 * @since 1.8.0 
		 */	
		public static function filter__load_field_groups( $field_groups ) {
			
			if ( ! is_array($field_groups) || empty($field_groups) ) {
				return $field_groups;
			}

			$options = array('title');

			foreach( $field_groups as $_key=>$_field ) {
				foreach( $options as $_option ) {
					if ( ! empty($_field[$_option]) && WPGlobus_Core::has_translations( $_field[$_option] ) ) {
						$field_groups[$_key][$_option] = WPGlobus_Core::text_filter( $_field[$_option], WPGlobus::Config()->language );
					}					
				}
			}
			
			return $field_groups;
		}			
	}
		
endif; // class WPGlobusPlus_Acf_Options.

# --- EOF