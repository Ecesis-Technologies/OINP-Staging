<?php
/**
 * File: class-wpglobus-plus-publish-extend.php
 *
 * @package WPGlobus Plus
 */
 
if ( ! class_exists( 'WPGlobusPlus_Publish_Extend' ) ) :

	/**
	 * Class WPGlobusPlus_Publish_Extend
	 */
	class WPGlobusPlus_Publish_Extend {

		/**
		 * Constructor.
		 */
		public static function constructor( $publish_action_links ) {
			
			self::set_sections();
			
			/**
			 * Check section.
			 */
			if ( empty( $_GET['section'] ) ) {
				self::single_action( $publish_action_links['single-action'] );			
			} else if ( 'single-action' == $_GET['section'] ) {
				self::single_action( $publish_action_links['single-action'] );			
			} else if ( 'post-action' == $_GET['section'] ) {
				self::post_action( $publish_action_links['post-action'] );			
			} else if ( 'test' == $_GET['section'] ) {
				self::section_test();			
			} else if ( 'react_test' == $_GET['section'] ) {
				self::section_react_test();			
			} else {
				self::single_action( $publish_action_links['single-action'] );			
			}
		}

		/**
		 * @since 1.8.3 @W.I.P
		 */
		public static function section_react_test() {
			/*
			echo '<h3>';
				esc_html_e( 'Language statuses', 'wpglobus-plus' );
			echo '</h3>';			
			echo '<div id="wp-react-app"></div>';
			//*/
		}
		
		/**
		 * Test section.
		 */		
		public static function section_test() {
			echo '<h3>';
			esc_html_e( 'Languages status', 'wpglobus-plus' );
			echo '</h3>';
			
			if ( ! class_exists('WPGlobusPlus_Publish') ) {
				require_once( WPGlobusPlus::$PLUGIN_DIR_PATH . 'includes/class-wpglobus-plus-publish2.php');
			}
			$pbl = new WPGlobusPlus_Publish();
			
			$language_post_status_key 	= $pbl->get_language_post_status_key();
			
			$language_status_key 		= $pbl->get_language_status_key();
			
			$opts = get_option( $language_status_key );
			
			$args = array(
				'post_type' 		=> 'any',
				'posts_per_page' 	=> -1,
				'orderby' 			=> 'ID',
				'order'   			=> 'DESC',				
				'meta_key' 			=> $language_post_status_key,
				'meta_compare'		=> 'EXISTS',
			);
			$query = new WP_Query( $args );			
	
			if ( empty( $query->posts ) ) {
				echo '<p>';
				esc_html_e( 'No items found.', 'wpglobus-plus' );
				echo '</p>';
				return;
			}
			
			echo '<table>';
			echo '<tbody>';
			echo '<thead>';
			echo 	'<tr>';
			echo 		'<th>Post ID</th>';
			echo 		'<th style="text-align:center;">Post type</th>';
			echo 		'<th style="text-align:center;">Post title</th>';
			echo 		'<th style="text-align:center;">Post status</th>';
			echo 		'<th style="text-align:center;">Language statuses</th>';
			echo 		'<th style="text-align:center;">Checking result</th>';
			echo 	'</tr>';
			echo '</thead>';
	
			$extra_languages = WPGlobus::Config()->enabled_languages;
			unset( $extra_languages[0] );
	
			foreach( $query->posts as $post ) {

				$url = add_query_arg(
					array(
						'post'		=> $post->ID,
						'action'	=> 'edit'
					),
					admin_url( 'post.php' )
				);		
			
				$meta 	= get_post_meta($post->ID, $language_post_status_key, true);
				$status = '';
				$result = '';
				
				$langs = $extra_languages;
				
				foreach( WPGlobus::Config()->enabled_languages as $language ) {

					if ( empty( $meta[$language] ) || 'publish' == $meta[$language] ) {
						
						$status .= '<span class="wpglobus-pub-language wpglobus-status-publish" title="Publish">&nbsp;&nbsp;'.$language.'&nbsp;&nbsp;</span>&nbsp;';
						$key = array_search($language, $langs);
						unset( $langs[$key] );
					
					} else if ( 'draft' == $meta[$language] )  {
						
						$status .= '<span class="wpglobus-pub-language wpglobus-status-draft" title="Draft">&nbsp;&nbsp;'.$language.'&nbsp;&nbsp;</span>&nbsp;';

						/**
						 * Check in opts.
						 */
						if ( in_array($post->ID, $opts[$language] ) ) {
							$key = array_search($language, $langs);
							unset( $langs[$key] );
						}	
					}
				}

				if ( empty($langs) ) {
					$result = 'ok';
				}
				
				echo '<tr>';
					echo '<td>'. $post->ID . '</td>';
					echo '<td>'. $post->post_type . '</td>';
					echo '<td><a href="'.$url.'" target="_blank">'. apply_filters( 'the_title', $post->post_title ) . '</a></td>';
					echo '<td>'. $post->post_status . '</td>';
					echo '<td>'. $status . '</td>';
					echo '<td>'. $result . '</td>';
				echo '</tr>';
				
			}
			echo '</tbody>';
			echo '</table>';
			
		}
		
		/**
		 * Create sections.
		 *
		 * @since 1.3.0 Added Bulk actions section.
		 */	
		public static function set_sections() {

			if ( ! class_exists('WPGlobusPlus_Sections') ) {
				require_once( WPGlobusPlus::$PLUGIN_DIR_PATH . 'includes/admin/class-wpglobus-plus-sections.php' );
			}
			
			$single_action_id = 'single-action';
			$post_action_id   = 'post-action';
			$test_id 		  = 'test';
			
			$url_single_action = add_query_arg(
				array(
					'page'		=> WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
					'tab'		=> 'publish',
					'section'	=> $single_action_id
				),
				admin_url( 'admin.php' )
			);

			$url_post_action = add_query_arg(
				array(
					'page'		=> WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
					'tab'		=> 'publish',
					'section'	=> $post_action_id
				),
				admin_url( 'admin.php' )
			);	
			
			$url_test = add_query_arg(
				array(
					'page'		=> WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
					'tab'		=> 'publish',
					'section'	=> $test_id
				),
				admin_url( 'admin.php' )
			);				
	
			$react_test_link = add_query_arg(
				array(
					'page'		=> WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
					'tab'		=> 'publish',
					'section'	=> 'react_test'
				),
				admin_url( 'admin.php' )
			);		
	
			$args = array(
				'sections' => array(
					$single_action_id	=> array(
						'caption' 	=> esc_html__( 'Single Action', 'wpglobus-plus' ),
						'link'		=> $url_single_action
					),
					$post_action_id	=> array(
						'caption' 	=> esc_html__( 'Single Post Action', 'wpglobus-plus' ),
						'link'		=> $url_post_action	
					),
					$test_id	=> array(
						'caption' 	=> 'Test Mode',
						'link'		=> $url_test	
					),
					// @since 1.8.3 @W.I.P
					// 'react_test'	=> array(
						// 'caption' 	=> 'React Test',
						// 'link'		=> $react_test_link
					// )
				)
			);
			
			new WPGlobusPlus_Sections($args);
			
		}
		
		/**
		 * Set draft for single language.
		 *
		 * @param string $single_action_link Link to page to set draft status.
		 *
		 * @return void
		 */
		public static function single_action( $single_action_link = '' ) {

			$custom_post_types = get_post_types( array( '_builtin' => false ) );

			$post_types = array(
				'post',
				'page',
			);

			/**
			 * Filter the array of disabled entities on page of module Publish.
			 *
			 * @since 1.1.22
			 * @scope admin
			 *
			 * @param array WPGlobus::Config()->disabled_entities Array of disabled entities.
			 */
			$disabled_entities = apply_filters( 'wpglobus_plus_publish_bulk_disabled_entities', WPGlobus::Config()->disabled_entities );
			
			foreach ( $custom_post_types as $type ) {
				if ( ! in_array( $type, $disabled_entities, true ) ) {
					$post_types[] = $type;
				}
			}

			echo '<p style="color: white; background-color: red; padding: .5em">';
			esc_html_e( 'WARNING: this operation is non-reversible. It is strongly recommended that you backup your database before proceeding.', 'wpglobus-plus' );
			echo '</p>';	
	
			echo '<h3>';
			esc_html_e( 'Set draft status', 'wpglobus-plus' );
			echo '</h3>';

			echo '<p>';
			esc_html_e( 'By default, when you publish a post, all languages get the "published" status. By using this tool, you can set specific language(s) to draft, for any post, page or custom post type.', 'wpglobus-plus' );
			echo '</p>';

			/**
			 * Item one.
			 * 
			 * @since 1.8.7
			 */			
			echo '<div class="item item-one">';
				echo '<p>';
				esc_html_e( '1. Select a language and the post type:', 'wpglobus-plus' );
				echo '</p>';

				/**
				 * Set languages
				 */
				$select = '<p><select id="language" class="wpglobus-select" data-mask="{{language}}">';
				$select .= '<option value="{{language}}">-- ' .
						   /* translators: drop-down menu prompt */
						   esc_html( __( 'select a language', 'wpglobus-plus' ) ) .
						   ' --</option>';
				foreach ( WPGlobus::Config()->enabled_languages as $language ) {

					if ( WPGlobus::Config()->default_language !== $language ) {
						$select .= '<option value="' . $language . '">' . WPGlobus::Config()->en_language_name[ $language ] . '</option>';
					}
				}
				$select .= '</select></p>';

				echo $select; // WPCS: XSS ok.

				/**
				 * Set post types.
				 */
				$select = '<p><select id="post_type" class="wpglobus-select" data-mask="{{post_type}}">';
				$select .= '<option value="{{post_type}}">-- ' .
						   /* translators: drop-down menu prompt */
						   esc_html( __( 'select a post type', 'wpglobus-plus' ) ) .
						   ' --</option>';
				foreach ( $post_types as $type ) {
					$select .= "<option data-mask='{{post_type}}' value='$type'>" . $type . '</option>';
				}
				$select .= '</select></p>';

				echo $select; // WPCS: XSS ok.
			echo '</div>';
			
			/**
			 * Item 2 inactive by default.
			 *
			 * @since 1.8.7
			 */
			echo '<div class="item item-two inactive">';
				echo '<p>';
				esc_html_e( '2. Click the link below:', 'wpglobus-plus' );
				echo '</p>';
				?>
				<p><a class="wpglobus-plus-publish-single-action_link button" href="<?php echo esc_url( $single_action_link ); ?>">
					<?php echo esc_html( $single_action_link ); ?>
				</a></p><?php
			echo '</div>';
		}
		
		/**
		 * Bulk actions.
		 *
		 * @since 1.3.0
		 * @since 1.8.3 Renamed from `bulk_actions` to `post_action`.
		 * 
		 * @param string $action_link Link to page to set draft status.
		 * @return void
		 */
		public static function post_action( $action_link = '' ) {

			echo '<p style="color: white; background-color: red; padding: .5em">';
			esc_html_e( 'WARNING: this operation is non-reversible. It is strongly recommended that you backup your database before proceeding.', 'wpglobus-plus' );
			echo '</p>';	

			$post_id = '';
			$action = '';
			$message = '';
			if ( ! empty( $_GET['post_id'] ) ) {
				
				$post_id = sanitize_text_field( $_GET['post_id'] );
				$post_id = (int) $post_id;
				
				if ( $post_id > 0 ) {
					
					$_post = get_post( $post_id );
					$action = 'action_by_post_id';

					if ( ! $_post instanceof WP_Post ) {
						$action = 'no_action';
						$message = esc_html__( 'Incorrect post_id parameter.', 'wpglobus-plus' );
					}
				}
			} else {
				$action = 'no_action';
				$message  = esc_html__( 'No post_id parameter.', 'wpglobus-plus' );				
				$message1 = esc_html__( 'To change the language status for a specific post, on the edit page', 'wpglobus-plus' );
				$message2 =
					sprintf(
						esc_html__( 'in the %1$sPublish%2$s metabox, click the %1$sPost Action%2$s button (see the screenshot)', 'wpglobus-plus' ),
						'<strong>',
						'</strong>'
					);
			}
			
			switch ($action) {
				case 'action_by_post_id':
					$post = get_post($post_id);
					$post_url = add_query_arg(
						array(
							'post'		=> $post_id,
							'action'	=> 'edit'
						),
						admin_url( 'post.php' )
					);		
					echo '<h3>';
						esc_html_e( 'Set draft status', 'wpglobus-plus' );
						echo ' ';
						esc_html_e( 'for post ID', 'wpglobus-plus' );
						echo ': ' . $post_id . ' - ' . '<a href="'.$post_url.'">'.apply_filters( 'the_title', $post->post_title ).'</a>';
						echo '</h3>';
					echo '<p>';
						esc_html_e( 'By default, when you publish a post, all languages get the "published" status. By using this tool, you can set specific language(s) to draft, for the post by specifying `post_id`.', 'wpglobus-plus' );
					echo '</p>';
					
					self::set_drafts_by_post_id( $post_id, $action_link );
					break;
				case 'action_by___ANYTHING_ELSE___':
					break;
				case 'no_action':
					echo '<h3>';
						esc_html_e( 'Set draft status', 'wpglobus-plus' );
						echo ': ' . $message;
					echo '</h3>';					
					echo '<div>';					
						echo $message1;					
					echo '</div>';					
					echo '<div>';					
						echo $message2;					
					echo '</div>';					
					echo '<div style="margin-top:30px;">';					
						echo '<img style="width:300px;height:500px;display:none;" class="module-publish-metabox-actions" src="'.WPGlobusPlus::$PLUGIN_DIR_URL.'assets/images/module-publish-metabox-actions.jpg" />';					
					echo '</div>';					
					break;
			}
		}

		/**
		 * Set draft status by post ID.
		 *
		 * @since 1.3.0
		 * 
		 * @param string $post_id	  Post ID.
		 * @param string $action_link Link to page to set draft status.
		 * @return void
		 */
		protected static function set_drafts_by_post_id( $post_id, $action_link = '' ) {
	
			/**
			 * Set languages select.
			 */
			$select = '<p><select id="wpglobus-plus-publish-languages" class="wpglobus-select" data-mask="" name="languages[]" multiple="multiple">';

			/**
			 * Use `for` to test.
			 */
			for ( $i=0; $i<1; $i++ ) {
				$__id = '';
				if ( $i > 0 ) {
					$__id = '-'.$i;
				}
				foreach ( WPGlobus::Config()->enabled_languages as $language ) {

					if ( WPGlobus::Config()->default_language !== $language ) {
						$select .= '<option value="' . $language . $__id . '">' . WPGlobus::Config()->en_language_name[ $language ] . $__id . '</option>';
					}
				}
			}
			$select .= '</select></p>';
	
			$_caption = esc_html__( 'Select all languages', 'wpglobus-plus' );
			$select_all_button = '<a href="#" onclick="return false;" class="button button-primary wpglobus-plus-publish-languages-add-all">' .	$_caption . '</a>';
			$_caption = esc_html__( 'Delete all languages', 'wpglobus-plus' );
			$delete_all_button = '<a href="#" onclick="return false;" class="button wpglobus-plus-publish-languages-delete-all">' .	$_caption . '</a>';
			$_caption = esc_html__( 'Start processing', 'wpglobus-plus' );
			$submit_button = '<input type="submit" class="button button-primary wpglobus-plus-publish-bulk-start hidden" value="' . $_caption . '" />';

			echo '<br />';
			echo $select_all_button;
			echo '&nbsp;&nbsp;&nbsp;';
			echo $delete_all_button;
			echo $select; ?>
			<form name="wpglobus-publish-form" action="">
				<input type="hidden" name="action-link" value="<?php echo $action_link; ?>" />
				<input type="hidden" name="language-ids" value="[]" />
				<input type="hidden" name="post-id" value="<?php echo $post_id; ?>" />
				<?php echo $submit_button; ?>
			</form
			<?php			
		}
		
	}

endif;

# --- EOF
