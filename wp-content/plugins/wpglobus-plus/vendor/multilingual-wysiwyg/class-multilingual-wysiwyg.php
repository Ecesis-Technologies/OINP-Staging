<?php
/**
 * File: class-multilingual-wysiwyg.php
 *
 * @copyright Copyright 2021 Alex Gor.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	
if ( ! class_exists( 'Multilingual_WYSIWYG' ) ) :

	/**
	 * Class Multilingual_WYSIWYG.
	 */
	class Multilingual_WYSIWYG {

		/**
		 * @var bool $_SCRIPT_DEBUG Internal representation of the define('SCRIPT_DEBUG')
		 */
		protected static $_SCRIPT_DEBUG = false;
	
		/**
		 * @var string $_SCRIPT_SUFFIX Whether to use minimized or full versions of JS.
		 */
		protected static $_SCRIPT_SUFFIX = '.min';	
	
		/**
		 * Arguments.
		 */
		static $args = array();
		
		/**
		 * Static constructor.
		 */
		public static function construct( $args = array() ) {
			
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				return;
			}
			
			/**
			 * Parse arguments.
			 */
			self::parse_args($args);
			
			/**
			 * Check for enabled current pages.
			 */
			if ( ! self::is_enabled_current_page() ) {
				return;
			}
			
			$_run = false;
			switch( self::get_arg('provider') ) {
				case 'WPGlobus':
					$_run = self::init_provider_wpglobus();					
					break;
				case 'self':
					break;
			}
				
			if ( ! $_run ) {
				return;
			}
			
			if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
				self::$_SCRIPT_DEBUG  = true;
				self::$_SCRIPT_SUFFIX = '';
			}

			/**
			 * Add filters for the full editor configuration (teeny=false).
			 * @see https://codex.wordpress.org/Function_Reference/wp_editor
			 */
			add_filter( 'mce_buttons', array( __CLASS__, 'filter__mce_buttons' ), 10, 2 );
			add_filter( 'mce_external_plugins', array( __CLASS__, 'filter__mce_external_plugins' ) );			

			/**
			 * Add filters for the minimal editor configuration (teeny=true).
			 * @see   https://codex.wordpress.org/Function_Reference/wp_editor
			 */
			add_filter( 'teeny_mce_buttons', array( __CLASS__, 'filter__mce_buttons' ), 10, 2 );
			add_filter( 'teeny_mce_plugins', array( __CLASS__, 'filter__teeny_mce_plugins' ) );
		
			add_action( 'admin_print_scripts', array(
				__CLASS__,
				'on__admin_print_scripts',
			), 1000 );	

			/**
			 * Test page.
			 */
			/* 
			add_action( 'admin_menu', array(
				__CLASS__,
				'on__admin_menu',
			), 10 );
			// */
		}

		/**
		 * Provider: WPGlobus.
		 */
		public static function init_provider_wpglobus() {
			if ( ! class_exists( 'WPGlobus' ) ) {
				return false;
			}
			add_filter( 'wpglobus_enabled_pages', array( __CLASS__, 'filter__wpglobus_enabled_pages' ) );
			return true;	
		}

		/**
		 * Provider: WPGlobus.
		 */
		public static function filter__wpglobus_enabled_pages( $pages ) {
			
			if ( ! self::get_arg('enabled_pages') ) {
				return $pages;
			}
			
			global $pagenow;
			
			if ( in_array( $pagenow, self::get_arg('enabled_pages') ) ) {
				$pages[] = $pagenow;
			}
			
			if ( ! empty( $_GET['page'] ) && in_array( $_GET['page'], self::get_arg('enabled_pages') ) ) {
				$pages[] = $_GET['page'];
			}
					
			return $pages;
		}
		
		/**
		 * Check for enabled current pages.
		 */	
		public static function is_enabled_current_page() {
			
			if ( ! self::get_arg('enabled_pages') ) {
				// Running on any page.
				return true;
			}
			
			global $pagenow;
			
			if ( in_array( $pagenow, self::get_arg('enabled_pages') ) ) {
				return true;
			}
			
			if ( ! empty( $_GET['page'] ) && in_array( $_GET['page'], self::get_arg('enabled_pages') ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Get argument.
		 */
		public static function get_arg( $arg = '' ) {
			if ( empty( $arg ) ) {
				return false;
			}
			if ( ! isset( self::$args[$arg] ) ) {
				return false;
			}
			
			return self::$args[$arg];
		}
		
		/**
		 * Get all arguments.
		 */
		public static function get_args() {
			return self::$args;
		}
		
		/**
		 * Enqueue admin script.
		 */
		public static function on__admin_print_scripts() {

			$data = array(
				'provider' 	 	  => self::get_arg('provider'),
				'_SCRIPT_DEBUG'   => self::$_SCRIPT_DEBUG,
				'defaultLanguage' => self::get_default_language(),
				'languages' 	  => self::get_languages(),
				'editor_id' 	  => self::get_arg('editor_id'),
				'submit_element'  => self::get_arg('submit_element'),
			);
			
			if ( empty( $data['languages'] ) ) {
				// @todo Fix case with empty laguages array.
			} else {
				/**
				 * Fix case when first language is not language by default.
				 */
				$keys = array_keys( $data['languages'] );
				if ( $keys[0] !== $data['defaultLanguage'] ) {
					$value = $data['languages'][ $data['defaultLanguage'] ];
					unset( $data['languages'][ $data['defaultLanguage'] ] );
					$data['languages'] = array_merge( array($data['defaultLanguage']=>$value), $data['languages'] );
				}
				/**
				 * Fix case when array contains not only 'language_code'=>'language_name' pairs.
				 */
				foreach( $data['languages'] as $_key=>$_value ) {
					if ( ! is_string($_key) || strlen($_key) != 2 ) {
						unset( $data['languages'][$_key] );
						$data['languages'][$_value] = $_value;
					}
				}
			}
			
			wp_register_script(
				'multilingual-wysiwyg',
				self::url_js( 'multilingual-wysiwyg' ),
				array( 'jquery', 'underscore' ),
				MULTILINGUAL_WYSIWYG_VERSION,
				true
			);
			wp_enqueue_script( 'multilingual-wysiwyg' );
			wp_localize_script(
				'multilingual-wysiwyg',
				'MultilingualWYSIWYG',
				array(
					'version' => MULTILINGUAL_WYSIWYG_VERSION,				
					'data' 	  => $data
				)
			);			
		}
	
		/**
		 * @since 1.0.0
		 */
		public static function get_default_language() {
			
			$default_language = false;
			switch( self::get_arg('provider') ) {
				case 'WPGlobus':
					$default_language = WPGlobus::Config()->default_language;							
					break;
				case 'self':
					$default_language = 'en';
					break;
			}			
			
			return $default_language;
		}

		/**
		 * @since 1.0.0
		 */		
		public static function get_languages() {

			$languages = array();
			
			switch( self::get_arg('provider') ) {
				case 'WPGlobus':
					foreach ( WPGlobus::Config()->enabled_languages as $code ) {
						$languages[$code] = WPGlobus::Config()->en_language_name[$code];
					}					
					break;
				case 'self':
					$languages = array( 'en'=>'English', 'ru'=>'Russian' );
					break;
			}			
			
			return $languages;
		}
		
		/**
		 * Test page.
		 * http://site/wp-admin/admin.php?page=multilingual-wysiwyg
		 */
		public static function on__admin_menu() {
			add_submenu_page(
				null,
				'',
				'',
				'administrator',
				'multilingual-wysiwyg',
				array(
					__CLASS__,
					'multilingual_wysiwyg_page',
				)
			);			
		}
		
		/**
		 * Test form.
		 */
		public static function multilingual_wysiwyg_page() { ?>
<form method="post" style="margin-top:150px">
	<h1 id="myeditable-h1">This Title Can Be Edited If You Click Here</h1>

	<div id="myeditable-div">
	  <p>This section of content can be edited. Click here to see how.</p>
	</div>
	<textarea style="display:none;" name="description"></textarea>
	<?php
	$settings = array(
		'wpautop' => true,
		'media_buttons' => true,
		'quicktags' => true,
		'textarea_rows' => '10',
		'textarea_name' => 'description'
	);
	echo '<div style="width:800px;">';
		wp_editor(wp_kses_post('{:en}my content{:}{:ru}Мой контент{:}{:fr}My content FR{:}' , ENT_QUOTES, 'UTF-8'), 'filial_description', $settings);
	echo '</div>';
	echo '<div style="width:800px;">';
		// wp_editor( '', 'full_description', $settings);
		wp_editor(wp_kses_post('{:en}my content ZZ {:}{:ru}Мой контент ЫЫЫ{:}{:fr}My content FR ZZZ{:}' , ENT_QUOTES, 'UTF-8'), 'full_description', $settings);
	echo '</div>';	
	?>		
</form><?php
		}
		
		/**
		 * @since 1.0.0
		 *
		 * @param array  $buttons   First-row list of buttons.
		 * @param string $editor_id Unique editor identifier, e.g. 'content'.
		 *
		 * @return array
		 */
		public static function filter__mce_buttons( $buttons, $editor_id ) {
			$buttons[] = 'ml_tinymce_language_select_button';
			return $buttons;
		}		

		/**
		 * @since 1.0.0
		 *
		 * @param array $plugins
		 *
		 * @return array
		 */
		public static function filter__mce_external_plugins( $plugins ) {
			$plugins['ml_tinymce_language_select_button'] = self::url_js( 'multilingual-wysiwyg-init' );
			// $plugins['mltinymce_language_splitbutton'] = self::url_js( 'multilingual-wysiwyg-init' );
			return $plugins;
		}

		/**
		 * @since 1.0.0
		 *
		 * @param array $plugins
		 *
		 * @return array
		 */
		public static function filter__teeny_mce_plugins( $plugins ) {
			$plugins[] = 'ml_tinymce_language_select_button';
			// $plugins[] = 'mltinymce_language_splitbutton';
			return $plugins;			
		}

		/**
		 * @since 1.0.0
		 */
		protected static function parse_args( $args ) {
			
			$defaults = array(
				'provider' 	 	 => 'self',
				'enabled_pages'  => false,
				'plugin_file' 	 => false,
				'vendor_path' 	 => false,
				'editor_id'   	 => false,
				'url_js'  		 => 'multilingual-wysiwyg/assets/js/',
				'url_css' 		 => 'multilingual-wysiwyg/assets/css/'
			);
			
			self::$args = wp_parse_args( $args, $defaults );
			
			if ( ! empty( self::$args['editor_id'] ) && is_string( self::$args['editor_id'] ) ) {
				self::$args['editor_id'] = array( self::$args['editor_id'] );
			}

			if ( ! empty( self::$args['enabled_pages'] ) && is_string( self::$args['enabled_pages'] ) ) {
				self::$args['enabled_pages'] = array( self::$args['enabled_pages'] );
			}
			
			if ( ! empty( self::$args['submit_element'] ) && is_string( self::$args['submit_element'] ) ) {
				self::$args['submit_element'] = array( self::$args['submit_element'] );
			}			

			if ( ! self::$args['vendor_path'] ) {
				self::$args['vendor_path'] = dirname( __FILE__ );
			}
		}
		
		/**
		 * Get JS URL.
		 * @since 1.0.0
		 */
		protected static function url_js( $script_name = '' ) {
			
			$_url = plugin_dir_url( self::get_arg('vendor_path') ) . self::get_arg('url_js');
			
			if ( $script_name ) {
				$_url .= $script_name . self::$_SCRIPT_SUFFIX . '.js';
			}
			return $_url;
		}

		/**
		 * Get CSS URL.
		 * @since 1.0.0 @W.I.P
		 */		
		protected static function url_css( $sheet_name = '' ) {}
		
	} // class Multilingual_WYSIWYG.

endif;

# --- EOF