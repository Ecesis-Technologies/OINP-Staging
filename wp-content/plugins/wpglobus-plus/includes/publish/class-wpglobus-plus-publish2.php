<?php
/**
 * File: class-wpglobus-plus-publish2.php
 *
 * Class WPGlobusPlus_Publish
 * @since 1.0.0
 */

if ( ! class_exists( 'WPGlobusPlus_Publish' ) ) :

	/**
	 * Class WPGlobusPlus_Publish
	 */
	class WPGlobusPlus_Publish {
		
		/**
		 * Module ID.
		 * @since 1.3.0
		 */
		const MODULE_ID = 'publish';
	
		/**
		 * Module Tab.
		 * @since 1.3.0
		 */	
		const PAGE_OPTION_TAB = 'publish';

		/**
		 * Default section.
		 * @since 1.3.0
		 */			
		const DEFAULT_SECTION = 'single-action';
		
		/**
		 * Meta key for languages post statuses.
		 */
		const LANGUAGE_POST_STATUS = '_wpglobus_plus_post_status';

		/**
		 * Option key for `wp_options` table.
		 */
		const LANGUAGE_STATUS = 'wpglobus_plus_language_status';

		/**
		 * @var bool $_SCRIPT_DEBUG Internal representation of the define('SCRIPT_DEBUG')
		 */
		protected static $_SCRIPT_DEBUG = false;

		/**
		 * @var string $_SCRIPT_SUFFIX Whether to use minimized or full versions of JS and CSS.
		 */
		protected static $_SCRIPT_SUFFIX = '.min';

		/**
		 * @var array of enabled statuses.
		 */
		protected static $statuses = array( 'publish', 'pending', 'draft' );

		/**
		 * @var array of post statuses.
		 */
		public $post_status = array();

		/**
		 * Constructor
		 */
		public function __construct() {

			if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
				self::$_SCRIPT_DEBUG  = true;
				self::$_SCRIPT_SUFFIX = '';
			}

			if ( is_admin() ) {

				add_action( 'wp_ajax_' . __CLASS__ . '_process_ajax', array(
					$this,
					'on__process_ajax'
				) );

				add_action( 'post_submitbox_misc_actions', array(
					$this,
					'on_add_pub_section'
				) );

				add_action( 'admin_print_scripts', array(
					$this,
					'on_admin_scripts'
				) );

				/** @since 1.3.0 */
				add_action( 'admin_print_scripts', array(
					$this,
					'on__scripts_publish_tab'
				) );

				/** @since 1.10.0 */
				add_action( 'admin_print_styles', array(
					$this,
					'on__print_styles',
				) );

				/** @since 1.3.0 */
				add_action( 'admin_print_styles', array(
					$this,
					'on__styles_publish_tab',
				) );

				add_filter( 'wpglobus_manage_language_item', array(
					$this,
					'on__manage_column'
				), 10, 3 );
				
				/** @since 1.10.0 */
				add_filter( 'wpglobus_manage_language_items', array(
					$this,
					'on__manage_language_items'
				), 10, 2 );

				/** @since 1.1.3 */
				add_action( 'admin_menu', array( $this, 'set_draft_menu' ) );

				/** @since 1.1.42 */
				add_action( 'wpglobus_gutenberg_metabox', array( $this, 'on__gutenberg_metabox' ) );

				/** @since 1.1.53 */
				add_filter( 'wpglobus_gutenberg_selector_text', array(
					$this,
					'filter__selector_text'
				), 10, 3 );
				
				/** @since 1.10.0 */
				add_filter( 'wpglobus_block_editor_localize_data', array( $this, 'filter__block_editor_localize_data' ), 10 );				
				
			} else {

				/**
				 * @scope front
				 */
				add_action( 'pre_get_posts', array(
					$this,
					'on__pre_get_posts'
				), 0 );

				/**
				 * @scope front
				 */
				add_filter( 'wpglobus_extra_languages', array(
					$this,
					'filter__extra_languages'
				), 10, 2 );

				/**
				 * Change the_content filter for plus version
				 * @todo 2015-10-09 This breaks WPG-WC and probably others because it checks for disabled post types on front. Besides, we need to check for the non-publish at the main query and go 404.
				 */
//				remove_filter( 'the_content', array( 'WPGlobus_Filters', 'filter__text' ), 0 );
//				add_filter( 'the_content', array(
//					$this,
//					'filter__text_content'
//				), 0 );

				/**
				 * @scope front
				 */
				add_filter( 'template_include', array(
					$this,
					'filter__template_include'
				) );

				/**
				 * @scope front
				 */
				add_filter( 'wpglobus_hreflang_tag', array(
					$this,
					'filter__hreflang'
				) );

				/**
				 * @scope front
				 */
				add_filter( 'get_pages', array(
					$this,
					'filter__get_pages'
				), 10, 2 );

				/**
				 * @scope front
				 */
				add_filter( 'wpglobus_first_visit_redirect', array(
					$this,
					'filter__wpglobus_first_visit_redirect'
				), 10, 2 );

				/**
				 * @scope front
				 * @since 1.6.0
				 */				
				add_filter( 'get_next_post_where',  array(
					$this,
					'filter__get_post_where'
				), 10, 5 );

				/**
				 * @scope front
				 * @since 1.6.0
				 */	
				add_filter( 'get_previous_post_where',  array(
					$this,
					'filter__get_post_where'
				), 10, 5 ); 
			}
		}

		/**
		 * Filters the WHERE clause in the SQL for an adjacent post query.
		 *
		 * @see wp-includes\link-template.php
		 * @return string
		 * @since 1.6.0
		 */
		public function filter__get_post_where( $where, $in_same_term, $excluded_terms, $taxonomy, $post ) {

			$language_status = $this->get_language_status( WPGlobus::Config()->language );

			if ( empty( $language_status ) || ! is_array( $language_status ) ) {
				return $where;
			}
			
			$ids = implode( ',', $language_status );
			return $where . " AND p.ID NOT IN ($ids)";
		}
		
		/**
		 * Filter the current language name.
		 *
		 * @return string
		 * @since 1.1.53
		 */
		public function filter__selector_text( $text, $language, $post ) {
			
			$language_status = get_post_meta( $post->ID, $this->get_language_post_status_key(), true );
			
			if ( isset($language_status[$language]) && 'draft' == $language_status[$language] ) {
				$text .= ' (draft)';
			}
		
			return $text;
		}
		
		/**
		 * Metabox callback.
		 */
		public function on__gutenberg_metabox() {
			$this->on_add_pub_section( WPGlobus::Config()->builder->get_id() );		
		}
		
		/**
		 * Filter for data to send to JS.
		 *
		 * @since 1.10.0
		 */
		public function filter__block_editor_localize_data($data) {
			
			if ( $this->use_switcher_v1() ) {
				return $data;
			}
			
			$data['switcherItems']['top']['elements'][] = array(
				'tagName' 	=> 'PubStatus',
				'callBack'  => 'WPGlobusPlusPublish',
				'props' => array(
					'style'		=> array(),
					'className' => 'pubstatus-switch',
					'title'		=> 'Click to change status',
				)
			);

			return $data;
		}
		
		/**
		 * Filter the first visit redirect.
		 * Returning a false value cancels redirect.
		 *
		 * @param string $redirect_to URL redirect to.
		 * @param string $language    Language redirect to.
		 *
		 * @return string|false
		 * @since 1.1.31
		 */
		public function filter__wpglobus_first_visit_redirect( $redirect_to, $language ) {

			if ( is_singular() ) {
				$post_status = get_post_meta( get_the_ID(), $this->get_language_post_status_key(), true );
				if ( isset( $post_status[ $language ] ) && 'draft' === $post_status[ $language ] ) {
					return false;
				}
			}

			return $redirect_to;
		}

		/**
		 * Filter get_pages.
		 *
		 * @see   filter wpglobus_hreflang_tag
		 * @since 1.0.0
		 *
		 * @param array $pages array of WP_Post objects
		 * @param array $r     UNUSED
		 *
		 * @return array
		 */
		public function filter__get_pages(
			$pages, /** @noinspection PhpUnusedParameterInspection */
			$r
		) {

			$posts_id = $this->get_language_status();

			foreach ( $pages as $key => $page ) {
				/** @var WP_Post $page */
				if ( in_array( $page->ID, $posts_id, true ) ) {
					unset( $pages[ $key ] );
				}
			}

			return $pages;
		}

		/**
		 * Filter hreflang tag
		 *
		 * @see   filter wpglobus_hreflang_tag
		 * @since 1.0.0
		 *
		 * @param array $hreflangs
		 *
		 * @return array
		 */
		public function filter__hreflang( $hreflangs ) {

			if ( is_singular() ) {

				global $post;

				$post_status = get_post_meta( $post->ID, $this->get_language_post_status_key(), true );

				if ( ! empty( $post_status ) ) :
					foreach ( $post_status as $language => $status ) {
						if ( ! empty( $hreflangs[ $language ] ) && in_array( $status, array(
								'draft',
								'pending'
							), true )
						) {
							unset( $hreflangs[ $language ] );
						}
					}
				endif;
			}

			return $hreflangs;
		}

		/**
		 * Add language status to flag.
		 *
		 * @see   filter wpglobus_manage_language_column
		 * @since 1.0.0
		 *
		 * @param string  $output
		 * @param WP_Post $post
		 * @param string  $language
		 *
		 * @return string
		 */
		public function on__manage_column( $output, $post, $language ) {

			/**
			 * FYI: this action doesn't fire for extra language that has not Post Title or/and Post Content,
			 * but it may has the draft status in Publish metabox on post.php page, so you don't see appropriate flag on edit.php page.
			 * 
			 */
			$post_status = get_post_meta( $post->ID, $this->get_language_post_status_key(), true );
			if ( ! empty( $post_status[ $language ] ) && $post_status[ $language ] !== 'publish' ) :
				$output .= ' - <strong>' . $post_status[ $language ] . '</strong>';
			endif;

			return $output;
		}
		
		/**
		 * Add language status switcher.
		 *
		 * @since 1.10.0
		 *
		 * @param array   $output
		 * @param WP_Post $post
		 *
		 * @return array
		 */
		public function on__manage_language_items( $output, $post ) {
			
			if ( $this->use_switcher_v1() ) {
				return $output;	
			}
			
			$output = array();
			
			$post_status = $this->get_post_status($post->ID);
			
			$element  = '<div class="wpglobus-publish-root" ';
			$element .= 'id="wpglobus-publish-root-'.$post->ID.'" ';
			$element .= 'data-post-id="'.$post->ID.'" ';
			$element .= "data-status='".json_encode($post_status)."'>";
			$element .= 'Loading...</div>';

			$output[] = $element;

			return $output;
		}
		
		/**
		 * Check language draft status for set 404 page.
		 *
		 * @see   filter template_include
		 * @since 1.0.0
		 * @since 1.3.8 Add filter `wpglobus_plus_publish_template_include_handler`.
		 *
		 * @param string $template
		 *
		 * @return string
		 */
		public function filter__template_include( $template ) {

			/**
			 * Filter to run or not of callback function.
			 *
			 * @since 1.3.8
			 *
			 * @param boolean true Default value.
			 */
			$handler = apply_filters( 'wpglobus_plus_publish_template_include_handler', true );
			
			if ( false === $handler ) {
				return $template;
			}

			global $wp_query;

			if ( is_singular() ) :

				$status = $this->get_language_status();

				if ( ! empty( $status ) ) {
					$post = get_post();
					if ( in_array( $post->ID, $status ) ) {
						$wp_query->set_404();
						status_header( 404 );
						nocache_headers();
						return get_404_template();
					}
				}

			endif;

			return $template;
		}
		
		/**
		 * Set query.
		 *
		 * @see   WP_Query::get_posts
		 * @since 1.0.0
		 * @since 1.5.7 Fixed resetting `post__not_in` values.
		 * @since 1.7.3 Added checking `is_feed`.
		 *
		 * @param WP_Query $obj The WP_Query instance (passed by reference).
		 */
		public function on__pre_get_posts( $obj ) {

			if ( is_admin() ) {
				return;
			}
			
			if ( $obj->is_archive || $obj->is_home || $obj->is_single || $obj->is_search || $obj->is_feed ) {

				$status = $this->get_language_status();

				if ( ! empty( $status ) ) {

					$_values = $obj->get('post__not_in');
					if ( empty( $_values ) ) {
						$obj->set( 'post__not_in', $status );
					} else {
						$obj->set( 'post__not_in', array_merge( $_values, $status ) );
					}
				}
			}
		}

		/**
		 * Get language status.
		 *
		 * @since 1.0.0
		 *
		 * @return array
		 */
		public function get_language_status( $language = '' ) {
		
			if ( empty($language) ) {
				$language = WPGlobus::Config()->language;
			}

			/** @var array $opts */
			$opts = get_option( self::LANGUAGE_STATUS );

			if ( ! empty( $opts[ $language ] ) ) {
				return $opts[ $language ];
			}

			return array();
		}

		/**
		 * Set post language status.
		 *
		 * @since 1.0.0
		 *
		 * @param array $post_status
		 *
		 * @return void
		 */
		public function config( Array $post_status = array() ) {

			$post = get_post();

			if ( empty( $post ) ) {
				return;
			}

			if ( ! count( $post_status ) ) {

				if ( $post->ID && ( is_single() || is_page() ) ) {

					$_post_status = get_post_meta( $post->ID, $this->get_language_post_status_key(), true );

					$statuses = array();

					foreach ( WPGlobus::Config()->open_languages as $language ) :

						if ( ! is_array( $_post_status ) || ! count( $_post_status ) ) {
							$statuses[ $language ] = 'publish';
						} elseif ( isset( $_post_status[ $language ] ) ) {
							$statuses[ $language ] = $_post_status[ $language ];
						} else {
							$statuses[ $language ] = 'publish';
						}

					endforeach;

					$this->post_status = array(
						'post_id'     => $post->ID,
						'post_status' => $statuses
					);

				}

			} else {

				$this->post_status = array(
					'post_id'     => $post->ID,
					'post_status' => $post_status
				);

			}

		}

		/**
		 * Set enabled languages.
		 *
		 * @see   filter wpglobus_extra_languages
		 * @since 1.0.0
		 *
		 * @param array  $languages
		 * @param string $current_language
		 *
		 * @return array
		 */
		public function filter__extra_languages(
			$languages, /** @noinspection PhpUnusedParameterInspection */
			$current_language
		) {
			$enabled_languages = $languages;

			if ( empty( $this->post_status ) ) {
				$this->config();
			}

			if ( is_single() || is_page() ) {


				foreach ( $languages as $key => $l ) :

					/**
					 * Exclude post with draft status for default language too
					 */
					/*
					if ( $l === WPGlobus::Config()->default_language ) {
						continue;
					}
					// */

					if ( isset( $this->post_status[ 'post_status' ][ $l ] ) && 'draft' === $this->post_status[ 'post_status' ][ $l ] ) {
						unset( $enabled_languages[ $key ] );
					}

				endforeach;

			}

			return $enabled_languages;

		}

		/**
		 * Callback for content
		 *
		 * @see   filter the_content
		 * @since 1.0.0
		 *
		 * @param string $text
		 *
		 * @return string
		 */
		public function filter__text_content( $text ) {

			$post = get_post();

			if ( WPGlobus::O()->disabled_entity( $post->post_type ) ) {
				return $text;
			}

			$wpglobus_post_status = get_post_meta( $post->ID, $this->get_language_post_status_key(), true );

			$status = 'publish';
			if ( ! empty( $wpglobus_post_status[ WPGlobus::Config()->language ] ) ) {
				$status = $wpglobus_post_status[ WPGlobus::Config()->language ];
			}

			switch ( $status ) :
				case 'draft' :
					//
					if ( WPGlobus::Config()->language === WPGlobus::Config()->default_language ) {
						$s = __( 'This post has been marked as Draft.', 'wpglobus-plus' );
					} else {
						$s = sprintf( __( 'This post is available in the main language (%s) only.', 'wpglobus-plus' ), WPGlobus::Config()->en_language_name[ WPGlobus::Config()->default_language ] );
					}

					return $s;
					break;
				case 'pending' :
					// TODO We should never come here.
					return esc_html( __( 'Please, visit later...', 'wpglobus-plus' ) );
					break;
			endswitch;

			return WPGlobus_Core::text_filter(
				$text,
				WPGlobus::Config()->language,
				null,
				WPGlobus::Config()->default_language
			);

		}

		/**
		 * Add section to Publish metabox.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function on_add_pub_section( $builder_id = false ) {

			if ( 'off' === WPGlobus::Config()->toggle ) {
				return;
			}

			$post = get_post();

			if ( WPGlobus::O()->disabled_entity( $post->post_type ) ) {
				return;
			}

			/**
			 * @since 1.3.0
			 */
			$post_action_url = add_query_arg(
				array(
					'page' => WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
					'tab' => self::PAGE_OPTION_TAB,
					'section' => 'post-action',
					'post_id' => $post->ID
				),
				admin_url( 'admin.php' )
			);		

			$language_status = get_post_meta( $post->ID, $this->get_language_post_status_key(), true );

			$menu_element = '<div id="wpglobus-pub-{{language}}" class="wpglobus-pub-status hidden">
						Post status in <span style="text-decoration:underline;">{{language_name}}</span> : 
						<ul>';
			foreach ( self::$statuses as $status ) {
				$class = 'wpglobus-status-' . $status;
				$menu_element .= '<li data-status="' . $status . '" data-language="{{language}}" class="' . $class . '"><span class="wpglobus-checkmark">&nbsp;</span>' . $status . '<span class="wpglobus-spinner">&nbsp;</span></li>';
			}
			$menu_element .= '
						</ul>
						{{pub_bulk_element}}
					</div>';


			$wpglobus_pub_raw = $menu = '';
	
			/**
			 * Added line feed for a string with a large languages number.
			 * @since 1.8.5
			 */
			$language_count = count( WPGlobus::Config()->open_languages );
			$_line_feed = '';
			if ( $language_count > 8 ) {
				$_line_feed = '<br />';
			}

			foreach ( WPGlobus::Config()->open_languages as $language ) {
				
				$class = ' wpglobus-status-publish';
				if ( isset( $language_status[ $language ] ) ) {
					$class = ' wpglobus-status-' . $language_status[ $language ];
				}

				$status = isset( $language_status[ $language ] ) ? $language_status[ $language ] : 'publish';
				$wpglobus_pub_raw .= '<span class="wpglobus-pub-language wpglobus-pub-selector-' . $language . $class . '" 
							data-language="' . $language . '" 
							data-status="' . $status . '"><strong>' . $language . '</strong></span>';
				$menu .= str_replace(
					array( '{{language}}', '{{language_name}}' ),
					array( $language, WPGlobus::Config()->en_language_name[ $language ] ),
					$menu_element
				);

				/**
				 * @since 1.3.0
				 */
				$bulk_actions_caption = esc_html__( 'Post Action', 'wpglobus-plus' ); 
				$pub_bulk_element = '<div style="padding-bottom:10px;text-align:right;" class="wpglobus-pub-bulk-mode"><a href="'.$post_action_url.'" class="button button-small">'.$bulk_actions_caption.'</a></div>';
				$menu = str_replace( 
					'{{pub_bulk_element}}', 
					$pub_bulk_element, 
					$menu 
				);					
			}
			?>
			<div class="misc-pub-section wpglobus-pub wpglobus-switch">
				<?php if ( $builder_id == 'gutenberg' ) {	?>
					<p style="font-weight: bold;">Module Publish:</p>
				<?php }	?>
				<span id="wpglobus-pub-raw">&nbsp;&nbsp;<?php _e( 'Status', 'wpglobus-plus' ); ?>:&nbsp;&nbsp;<?php echo $_line_feed; echo $wpglobus_pub_raw; ?></span>
				<span id="wpglobus-status-box"><?php echo $menu; ?></span>
			</div>
			<?php if ( $builder_id == 'gutenberg' ) {	?>
			<hr />
			<?php }	?>
			<?php
		}

		/**
		 * Enqueue admin styles.
		 *
		 * @since 1.3.0
		 * @return void
		 */
		public function on__styles_publish_tab() {
			
			if ( $this->is_tab( self::PAGE_OPTION_TAB ) ) {
				wp_enqueue_style(
					'select2-css',
					WPGlobus::$PLUGIN_DIR_URL . 'lib/select2.min.css',
					array(),
					'3.5.2'
				);
			}
		}
		
		/**
		 * Enqueue admin scripts.
		 *
		 * @since 1.3.0
		 * @return void
		 */
		public function on__scripts_publish_tab() {

			if ( $this->is_tab( self::PAGE_OPTION_TAB ) ) {

				wp_register_script(
					'select2-js',
					WPGlobus::$PLUGIN_DIR_URL . 'lib/select2.min.js',
					array( 'jquery' ),
					'3.5.2',
					true
				);

				wp_register_script(
					'wpglobus-plus-publish-tab',
					WPGlobusPlus_Asset::url_js( 'wpglobus-plus-publish-tab' ),
					array( 'jquery', 'select2-js' ),
					WPGLOBUS_PLUS_VERSION,
					true
				);
				wp_enqueue_script( 'wpglobus-plus-publish-tab' );
				wp_localize_script(
					'wpglobus-plus-publish-tab',
					'WPGlobusPlusPublishTab',
					array(
						'data' => array(
							'version'       => WPGLOBUS_PLUS_VERSION,
							'tab'     		=> empty($_GET['tab']) ? '' : sanitize_text_field( $_GET['tab'] ),
							'section'  		=> empty($_GET['section']) ? self::DEFAULT_SECTION : sanitize_text_field( $_GET['section'] ),
							#'statuses'     => self::$statuses,
							'process_ajax' => __CLASS__ . '_process_ajax'
						)
					)
				);
				
			}
		}

		/**
		 * Enqueue admin styles.
		 * 
		 * @since 1.10.0
		 *
		 * @return void
		 */
		public function on__print_styles() {

			if ( WPGlobus_WP::is_pagenow( array( 'post.php', 'post-new.php' ) ) ) :
			
				if ( WPGlobus::Config()->builder->is_builder_page('gutenberg') ) {
					wp_enqueue_style(
						'wpglobus-plus-publish',
						WPGlobusPlus_Asset::url_css( 'wpglobus-plus-publish' ),
						array(),
						WPGLOBUS_PLUS_VERSION
					);
				}
				
			endif;

			if ( WPGlobus_WP::is_pagenow( array( 'edit.php' ) ) && $this->use_switcher_v2() ) :
				
				/**
				 * We only have the minified version.
				 */
				$url = WPGlobusPlus::$PLUGIN_DIR_URL . 'assets/css/wpglobus-plus-publish-switcher.min.css';
				
				/**
				 * To force publish switchers v.1 `use_block_editor_sidebar_v1` function in @see wpglobus\includes\class-wpglobus.php.
				 */
				// 
				 
				/**
				 * Dev version.
				 */
				if ( defined('DEV_WPGLOBUS_PLUS_PUBLISH_SWITCHER_ASSETS_URL') ) {
					$url = DEV_WPGLOBUS_PLUS_PUBLISH_SWITCHER_ASSETS_URL . 'wpglobus-plus-publish-switcher.min.css';
				}
				
				wp_enqueue_style(
					'wpglobus-plus-publish-switcher',
					$url,
					array(),
					WPGLOBUS_PLUS_VERSION
				);
				
			endif;			
		}
		
		/**
		 * Enqueue admin scripts.
		 *
		 * @since 1.0.0
		 * @since 1.10.0 Using publish switcher v.2
		 *
		 * @return void
		 */
		public function on_admin_scripts() {
			
			/**
			 * Enqueue the script for publish status switcher.
			 *
			 * @since 1.10.0
			 */
			if ( WPGlobus_WP::is_pagenow( array( 'edit.php' ) ) && $this->use_switcher_v2() ) :
			
				/**
				 * We only have the minified version.
				 */
				$url = WPGlobusPlus::$PLUGIN_DIR_URL . 'assets/js/wpglobus-plus-publish-switcher.min.js';
				
				/**
				 * To force publish switchers v.1 `use_block_editor_sidebar_v1` function in @see wpglobus\includes\class-wpglobus.php.
				 */
				//
				 
				/**
				 * Dev version.
				 */				 
				if ( defined('DEV_WPGLOBUS_PLUS_PUBLISH_SWITCHER_ASSETS_URL') ) {
					$url = DEV_WPGLOBUS_PLUS_PUBLISH_SWITCHER_ASSETS_URL . 'wpglobus-plus-publish-switcher.min.js';
				}
			
				wp_register_script(
					'wpglobus-plus-publish-switcher',
					$url,
					array(),
					WPGLOBUS_PLUS_VERSION,
					true
				);
				wp_enqueue_script( 'wpglobus-plus-publish-switcher' );
				wp_localize_script(
					'wpglobus-plus-publish-switcher',
					'WPGlobusPlusPublishSwitcher',
					array(
						'version' => WPGLOBUS_PLUS_VERSION,
						'flagUrl' => WPGlobus::Config()->flags_url,
						'flag'    => WPGlobus::Config()->flag,
						'ajaxurl' => admin_url( 'admin-ajax.php' ),
						'enName'  => WPGlobus::Config()->en_language_name,
						'checkId' => 'wpglobus_languages',
						'rootSelector' => '.wpglobus-publish-root',
						'processAjax'  => __CLASS__ . '_process_ajax',
					)
				);
			endif;
			
			/**
			 *
			 */
			if ( WPGlobus_WP::is_pagenow( array( 'post.php', 'post-new.php' ) ) ) :
				
				$post = get_post();
				
				wp_register_script(
					'wpglobus-plus-publish',
					WPGlobusPlus_Asset::url_js( 'wpglobus-plus-publish' ),
					array( 'jquery' ),
					WPGLOBUS_PLUS_VERSION,
					true
				);
				wp_enqueue_script( 'wpglobus-plus-publish' );
				wp_localize_script(
					'wpglobus-plus-publish',
					'WPGlobusPlusPublish',
					array(
						'data' => array(
							'version'      => WPGLOBUS_PLUS_VERSION,
							'post_id'      => $post->ID,
							'statuses'     => self::$statuses,
							'process_ajax' => __CLASS__ . '_process_ajax',
							'postStatus'   => $this->get_post_status($post->ID),
						)
					)
				);

			endif;
		}
		
		/**
		 * Get post status.
		 *
		 * @since 1.10.0
		 *
		 * return array
		 */
		public function get_post_status( $post_id = false ) {
			
			if ( ! $post_id ) {
				return false;
			}

			$_status = get_post_meta( $post_id, $this->get_language_post_status_key(), true );
			
			$status = array();
			foreach( WPGlobus::Config()->enabled_languages as $language ) {
				if ( is_array($_status) && array_key_exists( $language, $_status ) ) {
					$status[$language] = $_status[$language];
				} else {
					$status[$language] = 'publish';
				}
			}
			
			return $status;
		}
		
		/**
		 * Set post status accordingly with language's status.
		 *
		 * @since 1.1.20
		 *
		 * @return array
		 */
		public function set_status( $order, $reset_status = false ) {

			/**
			 * Post meta table.
			 */
			$post_status = get_post_meta( $order['post_id'], $this->get_language_post_status_key(), true );

			if ( ! is_array( $post_status ) ) {
				// Meta value is invalid. Reset to an empty array.
				$post_status = array();
			}

			$result_meta = true;
			$message = '';
			$status_changed = false;

			if ( 'draft' === $order['status'] ) {
				if ( empty( $post_status[ $order['language'] ] ) || $post_status[ $order['language'] ] != $order['status'] ) {
					$post_status[ $order['language'] ] = $order['status'];
					$status_changed = true;
				}
			} else {
				unset( $post_status[ $order['language'] ] );
				$status_changed = true;
			}

			if ( empty( $post_status ) ) :
				$result_meta = update_post_meta( $order['post_id'], $this->get_language_post_status_key(), '' );
			else:
				if ( $status_changed ) {
					$result_meta = update_post_meta( $order['post_id'], $this->get_language_post_status_key(), $post_status );
				}
			endif;

			if ( $status_changed ) {
				if ( $result_meta ) {
					$message = esc_html( sprintf( __( 'Successfully set to "%s"', 'wpglobus-plus' ), ucfirst( $order['status'] ) ) );
				} else {
					$message = esc_html( sprintf( __( 'Setting to "%s" FAILED!', 'wpglobus-plus' ), ucfirst( $order['status'] ) ) );

				}
			} else {
				$message = esc_html( sprintf( __( 'Already set to "%s". Not changing.', 'wpglobus-plus' ), ucfirst( $order['status'] ) ) );
			}

			/**
			 * Options table.
			 */
			$result_option = true;
			$lang_status = get_option( self::LANGUAGE_STATUS );

			if ( empty( $post_status ) ) {

				if ( ! empty( $lang_status[ $order['language'] ] ) && isset( $lang_status[ $order['language'] ][ $order['post_id'] ] ) ) {
					unset( $lang_status[ $order['language'] ][ $order['post_id'] ] );
				}

			} else {

				if ( 'draft' === $order['status'] ) {
					$lang_status[ $order['language'] ][ $order['post_id'] ] = $order['post_id'];
				} else {
					if ( ! empty( $lang_status[ $order['language'] ] ) && isset( $lang_status[ $order['language'] ][ $order['post_id'] ] ) ) {
						unset( $lang_status[ $order['language'] ][ $order['post_id'] ] );
					}
				}

			};

			if ( isset( $lang_status[ $order['language'] ] ) && empty( $lang_status[ $order['language'] ] ) ) {
				unset( $lang_status[ $order['language'] ] );
			}

			if ( empty( $lang_status ) ) {
				$result_option = delete_option( self::LANGUAGE_STATUS );
			} else {

				$result_option = update_option( self::LANGUAGE_STATUS, $lang_status, false );
				if ( $reset_status ) {
					$result_option = $this->reset_status();
				}

			}

			$return = array();
			$return['action'] 	= $order['action'];
			$return['post_id'] 	= $order['post_id'];
			$return['language'] = $order['language'];
			$return['status'] 	= $order['status'];
			$return['message'] 	= $message;

			return $return;
		}

		/**
		 * Reset language statuses.
		 */
		public function reset_status() {

			$args = array(
				'post_type' 		=> 'any',
				'posts_per_page' 	=> -1,
				'orderby' 			=> 'ID',
				'order'   			=> 'DESC',
				'meta_key' 			=> $this->get_language_post_status_key(),
				'meta_compare'		=> 'EXISTS',
			);
			$query = new WP_Query( $args );

			$new_opts = array();

			foreach( $query->posts as $post ) {

				$meta = get_post_meta($post->ID, $this->get_language_post_status_key(), true);

				foreach( WPGlobus::Config()->enabled_languages as $language ) {

					if ( ! empty($meta[$language]) && $meta[$language] == 'draft' ) {
						$new_opts[$language][$post->ID] = $post->ID;
					}

				}

			}

			$result = update_option( self::LANGUAGE_STATUS, $new_opts, false );

			return $result;
		}

		/**
		 * Handle ajax process.
		 *
		 * @since 1.0.0
		 * @since 1.10.0
		 *
		 * @return void
		 */
		public function on__process_ajax() {
			
			$ajax_return = array();

			$order = $_POST['order'];
			
			if ( is_string($order) ) {
				
				$order = str_replace( '\"', '"', $order );
				$_order = json_decode($order);
				
				if ( is_object($_order) ) {
					$order = array(
						'action'   => $_order->action,
						'post_id'  => $_order->post_id,
						'language' => $_order->language,
						'status'   => $_order->status,
					);
				} else if ( is_array($_order) ) {
					$order = $_order;
				}
			}			

			switch ( $order['action'] ) :
				case 'set_status':

					$ajax_return['action'] = $order['action'];

					$result = $this->set_status($order, true);

					$ajax_return['result']  = 'ok';
					$ajax_return['status']  = $order['status'];
					$ajax_return['payload'] = $order;

					break;
			endswitch;

			echo json_encode( $ajax_return );
			die();
		}

		/**
		 * Get LANGUAGE_STATUS.
		 */
		public function get_language_status_key() {
			return self::LANGUAGE_STATUS;
		}

		/**
		 * Get LANGUAGE_POST_STATUS.
		 */
		public function get_language_post_status_key() {
			return self::LANGUAGE_POST_STATUS;
		}

		/**
		 * Hidden admin menu to call @see WPGlobusPlus_Publish::set_draft_callback
		 * @since 1.1.3
		 */
		public function set_draft_menu() {
			add_submenu_page( null,
				'WPG SET DRAFT', 'SET DRAFT',
				'manage_options',
				'wpglobus-set-draft',
				array(
					$this,
					'set_draft_callback'
				) );
		}

		/**
		 * Submenu page callback.
		 */
		public function set_draft_callback() {
			// Check for required parameter.
			if ( empty( $_GET['action'] ) ) {
				$this->warning_action('empty');
			} else {
				if ( 'single-action' == $_GET['action'] ) {			
					$this->set_draft_single_action();
				} else if ( 'post-action' == $_GET['action'] )  {
					$this->set_draft_for_post_action();
				} else {
					$this->warning_action('incorrect');
				}
			}
		}
		
		/**
		 * Prevent processing with empty/incorrect parameter `action`.
		 *
		 * @since 1.3.0
		 */
		public function warning_action( $status = '' ) {
			if ( 'empty' == $status ) {
				$message = esc_html__( 'Parameter `action` was not set.', 'wpglobus-plus' );
			} else {
				$message = esc_html__( 'Parameter `action` is incorrect.', 'wpglobus-plus' );
			}
			?>
			<div class="wrap">
				<h1>WPGlobus :: <?php esc_html_e( 'Set Draft', 'wpglobus-plus' ); ?></h1>
				<hr />
				<h3><?php echo $message; ?></h3>
				<?php $this->back_button(); ?>
			</div><!-- .wrap -->	
			<?php
		}
		
		/**
		 * Hidden admin page to set draft status to specific post type/language.
		 * @url   .../wp-admin/admin.php?page=wpglobus-set-draft&lang=fr&post_type=product
		 *
		 * @since 1.1.3
		 */
		public function set_draft_single_action() {
			?>
			<div class="wrap">
				<h1>WPGlobus :: <?php esc_html_e( 'Set Draft', 'wpglobus-plus' ); ?></h1>
				<hr />
				<?php

				$ok_to_process = true;

				// Check for required parameters.
				if ( empty( $_GET['lang'] ) || empty( $_GET['post_type'] ) ) {
					esc_html_e( 'URL format', 'wpglobus-plus' );
					echo ": &lang=...&post_type=...";

					$ok_to_process = false;
				}

				// Check if language is one of the enabled
				$language = $_GET['lang'];
				if ( ! WPGlobus_Utils::is_enabled( $language ) ) {
					echo '<p>';
					esc_html_e( 'Unknown language', 'wpglobus-plus' );
					echo ': ' . esc_html( $language );
					echo '</p>';

					$ok_to_process = false;
				}

				$post_type = $_GET['post_type'];

				/**
				 * Filter the array of disabled entities on page of module Publish.
				 *
				 * @since 1.1.22
				 * @scope admin
				 *
				 * @param array WPGlobus::Config()->disabled_entities Array of disabled entities.
				 */
				$disabled_entities = apply_filters( 'wpglobus_plus_publish_bulk_disabled_entities', WPGlobus::Config()->disabled_entities );

				if ( in_array( $post_type, $disabled_entities, true ) ) {
					echo '<p>';
					esc_html_e( 'Disabled post type', 'wpglobus-plus' );
					echo ': <strong>' . esc_html( $post_type ) . '</strong>';
					echo '</p>';

					$ok_to_process = false;
				}

				if ( $ok_to_process ) {

					echo '<h2>';
					echo esc_html( sprintf(
						__( 'Setting as "draft" all records with post type "%1$s" for language "%2$s"',
							'wpglobus-plus' ),
						$post_type, $language
					) );
					echo '</h2>';
					echo '<hr/>';

					// Get all posts with the specified type
					$posts = get_posts( array(
						'numberposts' => - 1,
						'post_type'   => $post_type,
						'orderby'     => 'ID',
						'order'       => 'ASC'
					) );

					echo '<table>';
					// Loop through the posts.
					foreach ( $posts as $post ) {

						$order = array(
							'action' 	=> 'set_status',
							'post_id' 	=> $post->ID,
							'language'	=> $language,
							'status'	=> 'draft'
						);

						$result = $this->set_status( $order );

						echo '<tr>';
						echo '<td>';
							// Print the post title and link to edit.
							printf(
								'<a href="%s">%s</a>',
								admin_url( '/post.php?post=' . $post->ID . '&action=edit' ),
								$post->ID
							);
						echo '</td>';
						echo '<td>';
							esc_html_e( apply_filters( 'the_title', $post->post_title ) );
						echo '</td>';
						echo '<td>';
							echo $result[ 'message' ];
						echo '</td>';
						echo '</tr>';

						//echo '<br/>';
					}
					echo '</table>';
					
					if ( count( $posts ) === 0 ) {
						esc_html_e( 'No records found.', 'wpglobus-plus' );
					} else {
						echo '<br/>';
						esc_html_e( 'Done.', 'wpglobus-plus' );
					}
				}
				$this->back_button('single-action');
				?>
			</div><!-- .wrap -->	
			<?php
		}

		/**
		 * Hidden admin page to output results of bulk setting draft status.
		 * 
		 * @since 1.3.0
		 */	
		protected function set_draft_for_post_action() {
			
			$post_id = '';
			if ( ! empty( $_GET['post_id'] ) ) {
				$post_id = (int) sanitize_text_field($_GET['post_id']);
			}
			?>
			<div class="wrap">
				<h1>WPGlobus :: <?php esc_html_e( 'Set Draft', 'wpglobus-plus' ); ?></h1>
				<hr />
				<?php
				$params = array();
				if ( ! empty($post_id) && $post_id > 0 ) {
					$this->process_by_post_id($post_id, $_GET['lang']);
					$params['post_id'] = $post_id;
				}
				$this->back_button('bulk-actions', $params);
				?>
			</div><!-- .wrap -->	<?php
		}
		
		/**
		 * Bulk action by post ID.
		 * 
		 * @since 1.3.0
		 */			
		protected function process_by_post_id( $post_id = 0, $languages = '' ) {
			
			echo '<h2>';
			echo esc_html( sprintf(
				__( 'Setting as "draft" for post ID "%1$s" for language(s) "%2$s"',
					'wpglobus-plus' ),
				$post_id, $languages
			) );
			echo '</h2>';
			echo '<hr/>';

			$success = true;

			// Get post.
			$post = get_post( $post_id );

			if ( $post instanceof WP_Post ) {
		
				$language_array = explode( ',', $languages );

				if ( ! empty($language_array) ) {
				
					/**
					 * Print the post title and link to edit.
					 */
					printf(
						'%s : <a href="%s">%s</a>',
						$post->ID,
						admin_url( '/post.php?post=' . $post->ID . '&action=edit' ),
						esc_html( apply_filters( 'the_title', $post->post_title ) )
					);
					
					$post_status = get_post_meta( $post->ID, $this->get_language_post_status_key(), true );
					
					if ( ! is_array( $post_status ) ) {
						// Meta value is invalid. Reset to an empty array.
						$post_status = array();
					}
					
					foreach( $language_array as $language ) {
						
						if ( ! in_array($language, WPGlobus::Config()->enabled_languages, true) ) {
							continue;
						}
						$post_status[$language] = 'draft';
						
					}

					/**
					 * Post meta table.
					 */
					$_result = update_post_meta( $post->ID, $this->get_language_post_status_key(), $post_status );
					
					if ( $_result ) {
						
						esc_html_e( 'Updated.', 'wpglobus-plus' );
						
						$opts = get_option(self::LANGUAGE_STATUS);
						
						foreach ( $post_status as $language=>$status ) {
							
							if ( empty($opts[ $language ]) ) {
								$opts[ $language ] = array();
							}
							
							$opts[ $language ][ $post->ID ] = $post->ID;
						}

						update_option( self::LANGUAGE_STATUS, $opts );
					}

				} else {
					esc_html_e( 'Empty array of languages.', 'wpglobus-plus' );
					$success = false;
				}
				
				
			} else {
				esc_html_e( 'No record found.', 'wpglobus-plus' );
				$success = false;
			}
			
			if ( $success ) {
				echo '<br/>';
				echo '<br/>';
				esc_html_e( 'Done.', 'wpglobus-plus' );
			}
		}
		
		/**
		 * Check current tab.
		 * 
		 * @since 1.3.0
		 */		
		protected function is_tab( $tab = '' ) {
			
			if ( empty($_GET['page']) || WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE != $_GET['page'] ) {
				return false;
			}
			
			if ( empty($tab) || empty($_GET['tab']) ) {
				return false;
			}
			
			if ( self::PAGE_OPTION_TAB == $_GET['tab'] ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Echo back button.
		 * 
		 * @since 1.3.0
		 */
		protected function back_button( $section = '', $params = array() ) {
			
			$args = array(
				'page' => WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
				'tab' => self::PAGE_OPTION_TAB
			);

			if ( ! empty($section) ) {
				$args['section'] = $section;
			}
			
			if ( ! empty($params) ) {
				foreach( $params as $key=>$value ) {
					$args[$key] = $value;
				}
			}
			
			$url = add_query_arg(
				$args,
				admin_url( 'admin.php' )
			);	
			
			$caption = esc_html__( 'Back to WPGlobus Plus', 'wpglobus-plus' );
			$button = '<hr />' .
			'<a href="'.$url.'" class="button button-primary">' .
				$caption .
			'</a>';

			echo $button;	
		}
		
		/**
		 * Check if we are using block editor sidebar switcher v.1.
		 *
		 * @since 1.10.0
		 */
		protected function use_switcher_v1() {
			
			if ( method_exists('WPGlobus', 'use_block_editor_sidebar_v1') ) {
				return WPGlobus::use_block_editor_sidebar_v1();
			}
			
			return true;
		}
		
		/**
		 * Check if we are using block editor sidebar switcher v.2.
		 *
		 * @since 1.10.0
		 */
		protected function use_switcher_v2() {

			if ( ! $this->is_post_type_enabled() ) {
				return false;
			}
			
			return ! $this->use_switcher_v1();
		}
		
		/**
		 * Check if post type is enabled.
		 * 
		 * @since 1.10.0
		 */
		protected function is_post_type_enabled( $post_type = false ) {
			
			if ( is_bool($post_type) && ! $post_type ) {
				$post_type = WPGlobus_Utils::safe_get('post_type');
			}
			
			if ( in_array( $post_type, WPGlobus::Config()->disabled_entities ) ) {
				return false;
			}
			
			return true;	
		}
		
	} // class WPGlobusPlus_Publish.

endif; // class_exists

# --- EOF
