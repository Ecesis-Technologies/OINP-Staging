<?php
/**
 * File: class-wpglobus-plus-wpglobeditor.php
 *
 * @since 1.1.0
 * @since 1.4.5 Added filter for elements by pages.
 */

if ( ! function_exists( 'convert_to_screen' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/template.php' );
}

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

if ( ! class_exists( 'WPGlobusPlus_Editor_Table' ) ) :

	/**
	 * Class WPGlobusPlus_Editor_Table
	 */
	class WPGlobusPlus_Editor_Table extends WP_List_Table {

		/**
		 * TAB constant.
		 *
		 * @since 1.4.5
		 */
		const TAB = 'wpglobeditor';

		/**
		 * All pages constant.
		 *
		 * @since 1.4.5
		 */
		const ALL_PAGES = 'none';

		public $data = array();

		public $skeleton_data = array();

		public $table_fields = array();

		public $found_data = array();

		public $option_key = 'wpglobus_plus_wpglobeditor';
		
		protected $filter_class = 'wpglobeditor-filter-{{page}}';

		/**
		 * Section by default.
		 *
		 * @since 1.4.5
		 */
		protected $default_section = 'general';
		
		/**
		 * Current section.
		 *
		 * @since 1.4.5
		 */
		protected $section = null;

		/**
		 * Array of sections.
		 *
		 * @since 1.4.5
		 */
		protected $sections = array( 'general' );

		/**
		 * @since 1.4.5
		 */		
		protected $options = null;

		/**
		 * Filter parameter from $_GET array.
		 *
		 * @since 1.4.5
		 */		
		protected $filter = false;
		
		/**
		 * Constructor
		 */
		public function __construct() {
	
			if ( is_null( $this->options ) ) {
				$this->options = get_option( $this->option_key );
			}
	
			/**
			 * @since 1.4.5
			 */	
			if ( ! empty($_GET['section']) && ! in_array( $_GET['section'], $this->sections ) ) {
				$this->section = $this->default_section;
			}
	
			/**
			 * @since 1.4.5
			 */		
			$this->set_filter();
	
			parent::__construct( array(
				'singular' => 'item',     //singular name of the listed records
				'plural'   => 'items',    //plural name of the listed records
				'ajax'     => true        //does this table support ajax?

			) );

			$this->get_data();

			$this->display_table();
		}

		/**
		 * Set filter property.
		 * @since 1.4.5
		 */	
		protected function set_filter() {

			if ( empty( $this->options['page_list'] ) ) {
				return false;
			}
			
			$_filter = false;
	
			if ( ! empty( $_GET['filter'] ) ) {
				$_filter = WPGlobus_Utils::safe_get( 'filter' );
			}

			$_found = false;
			foreach( $this->options['page_list'] as $page=>$attrs ) {
				if ( $_filter === $page ) {
					$_found = true;
					break;
				}
			}

			if ( $_found ) {
				$this->filter = $_filter;
				return;
			}
			
			if ( self::ALL_PAGES === $_filter ) {
				$this->filter = false;
				return;
			}

			$this->filter = array_key_first( $this->options['page_list'] );
		}
		
		/**
		 * Get filter property.
		 * @since 1.4.5
		 */	
		protected function get_filter() {
			return $this->filter;
		}			
		
		/**
		 * Display table.
		 */
		protected function display_table() {

			$data       = $this->data;
			$this->data = $this->skeleton_data;

			$this->prepare_items(); 
			
			/**
			 * @since 1.2.7
			 */
			$this->display_description();
			?>
			<div id="wpglobus-plus-skeleton" class="hidden">
				<?php $this->display('skeleton'); ?>
			</div>
			<?php
			$this->data = $data;
			$this->prepare_items(); ?>
			<form method="post" id="wpglobus-plus-editor-items">
				<input type="hidden" name="wpglobeditor-page-filter-class" value="<?php echo $this->filter_class; ?>">
				<input type="hidden" name="page" value="posts_list_table"><?php
				$this->display(); ?>
			</form>
			<?php
		}

		/**
		 * Get a list of columns. The format is:
		 * 'internal-name' => 'Title'
		 *
		 * @since 1.1.0
		 * @return array
		 */
		public function get_columns() {
			$columns = array();
			foreach ( $this->table_fields as $field => $attrs ) {
				$columns[ $field ] = $attrs['caption'];
			}

			return $columns;
		}

		/**
		 * Get data.
		 *
		 * @since  1.1.0
		 * @access public
		 */
		public function get_data() {

			$this->table_fields = array(
				'status'  => array(
					'caption'  => esc_html__( 'Status', 'wpglobus-plus' ),
					'sortable' => false,
				),
				'page'    => array(
					'caption'  => esc_html__( 'Page', 'wpglobus-plus' ),
					'sortable' => false,
					'order'    => 'desc'
				),
				'element' => array(
					'caption'  => sprintf(
					// translators: placeholders for 'id', 'name'
						esc_html__( '%1$s or %2$s of the HTML element', 'wpglobus-plus' ),
						'<strong>id</strong>', '<strong>name</strong>'
					),
					'sortable' => false
				),
				'action'  => array(
					'caption'  => esc_html__( 'Action', 'wpglobus-plus' ),
					'sortable' => false
				)
			);

			$opts = $this->options;

			if ( ! empty( $opts['page_list'] ) ) {

				$row = array();

				foreach ( $opts['page_list'] as $page => $attrs ) {
					
					/**
					 * If filter was set, then use it.
					 * @since 1.4.5
					 */
					if ( $this->get_filter() && $page !== $this->get_filter() ) {
						continue;
					}
					
					foreach ( $attrs as $key => $element ) {
						$row['ID']      = $page . '-' . $key;
						$row['status']  = ''; // TODO future use
						$row['page']    = $page;
						$row['key']     = $key;
						$row['element'] = $element;
						$row['action']  = '';
						$this->data[]   = $row;
					}
				}

			}

			$this->skeleton_data[0]['ID']      = '';
			$this->skeleton_data[0]['status']  = '';
			$this->skeleton_data[0]['page']    = '';
			$this->skeleton_data[0]['key']     = '';
			$this->skeleton_data[0]['element'] = '';
			$this->skeleton_data[0]['action']  = '';
		}

		/**
		 * Generates content for a single row of the table.
		 *
		 * @since 1.1.29
		 * @access public
		 *
		 * @param object $item The current item
		 */
		public function single_row( $item ) {
			echo '<tr class="wpglobeditor-item ' . $this->get_filter_class($item) . '">';
			$this->single_row_columns( $item );
			echo '</tr>';
		}
		
		/**
		 * Generate filter class.
		 * @since 1.1.29
		 */
		protected function get_filter_class($item) {

			if ( empty($item['page']) ) {
				return '';
			}
			
			$page  = str_replace( '.', '-', $item['page'] );
			return str_replace( '{{page}}', $page, $this->filter_class );
			
		}
	
		/**
		 * @see    WP_List_Table::column_default
		 * @since  1.1.0
		 * @param array $item
		 * @return string
		 */
		protected function column_status( $item ) {
			return sprintf(
				'<span class="wpglobus-plus-editor-status">%s</span>', $item['status']
			);
		}

		/**
		 * @see    WP_List_Table::column_default
		 * @since  1.1.0
		 * @param array $item
		 * @return string
		 */
		protected function column_page( $item ) {
			$content = sprintf(
				'<input class="wpglobus-plus-ajaxify page" data-action="save-page" type="text" name="page[%s]" id="page-%s" value="%s" data-key="%s" />',
				$item['ID'],
				$item['ID'],
				$item['page'],
				$item['key']
			);
			
			if ( ! $this->get_filter()  ) {
				$content .= '<span title="Filter" class="wpglobus-plus-wpglobeditor-filter" data-filter="' . $this->get_filter_class($item) . '">';
				$content .= '<img class="wpglobeditor-filter-icon" src="' . WPGlobusPlus_Asset::url_css() . '/images/item-filter.png' . '" />';
				$content .= '</span>';
			}
			
			return $content;
		}

		/**
		 * @see    WP_List_Table::column_default
		 * @since  1.1.0
		 * @access protected
		 * @param array $item
		 * @return string
		 */
		protected function column_element( $item ) {
			return sprintf(
				'<input class="wpglobus-plus-ajaxify element"  data-action="save-element" style="%s" type="text" name="element[%s]"  id="element-%s" value="%s" data-key="%s" />',
				'width:100%',
				$item['ID'],
				$item['ID'],
				$item['element'],
				$item['key']
			);
		}

		/**
		 * @see   WP_List_Table::column_default
		 * @since 1.1.0
		 * @param array $item
		 * @return string
		 */
		protected function column_action( $item ) {
			$content = '';
			/*
			$content = sprintf(
				'<a href="#" data-page="%s" data-key="%s" data-action="toggle" class="wpglobus-plus-action-ajaxify">Toggle</a> | ',
				$item['page'],
				$item['key']
			);
			// */
			$content .= sprintf(
				'<a href="#" data-page="%s" data-key="%s" data-action="remove" class="wpglobus-plus-action-ajaxify">' .
				esc_html__( 'Remove', 'wpglobus-plus' ) .
				'</a>',
				$item['page'],
				$item['key']
			);

			return $content;
		}

		/**
		 * Prepares the list of items for displaying.
		 *
		 * @uses   WP_List_Table::set_pagination_args()
		 * @see    WP_List_Table->prepare_items()
		 * @since  1.1.0
		 * @access public
		 */
		public function prepare_items() {

			$columns               = $this->get_columns();
			$hidden                = array();
			$sortable              = $this->get_sortable_columns();
			$this->_column_headers = array( $columns, $hidden, $sortable );

			/**
			 * Optional. You can handle your bulk actions however you see fit. In this
			 * case, we'll handle them within our package just to keep things clean.
			 */
####			$this->process_bulk_action();

			/**
			 * You can handle your row actions
			 */
####			$this->process_row_action();


####			usort( $this->data, array( &$this, 'usort_reorder' ) );

			// if ( isset($this->plugin_options['posts_per_page_text']) && !empty($this->plugin_options['posts_per_page_text'])) {
			// $per_page = $this->plugin_options['posts_per_page_text'];
			// } else {
			$per_page = 240;
			// }

			$current_page = $this->get_pagenum();
			$total_items  = count( $this->data );

			// only necessary because we have sample data
			$this->found_data = array_slice( $this->data, ( ( $current_page - 1 ) * $per_page ), $per_page );

			/**
			 * REQUIRED. We also have to register our pagination options & calculations.
			 */
			$this->set_pagination_args( array(
				'total_items' => $total_items,                  // WE have to calculate the total number of items.
				'per_page'    => $per_page,                     // WE have to determine how many items to show on a page.
				'total_pages' => ceil( $total_items / $per_page )   // WE have to calculate the total number of pages.
			) );

			/* 		$this->set_pagination_args( array(
						'total_items' => $total_items,                  // WE have to calculate the total number of items.
						'per_page'    => $per_page                     // WE have to determine how many items to show on a page.
					) ); */
			$this->items = $this->found_data;
		}

		/**
		 * Extra controls to be displayed between bulk actions and pagination
		 *
		 * @since  1.1.0
		 * @param string $which
		 */
		protected function extra_tablenav( $which ) {
			if ( 'top' !== $which ) {
				echo '<div class="wpglobus-plus-add" style="width:50%;"><input id="wpglobus-plus-add-item" type="button" class="button button-primary" value="' .
				     esc_attr__( 'Add', 'wpglobus-plus' ) .
				     '" /></div>';
			}
		}

		/**
		 * Display description for Editor Settings tab.
		 *
		 * @since 1.2.7
		 */
		protected function display_description() {

			$_url = add_query_arg(
				array(
					'page'        => WPGlobus::OPTIONS_PAGE_SLUG,
					'tab'         => 'customizer',
					'config-file' => 'show#current-theme',
				),
				admin_url( 'admin.php' )
			);

			echo '<p>';
			printf( // translators: %1 - id, %2 - name, %3 - Page.
				esc_html__( 'To find the element\'s %1$s or %2$s, inspect it in the browser console on the page specified in the parameter %3$s of the table.', 'wpglobus-plus' ),
				'<strong>id</strong>',
				'<strong>name</strong>',
				'<strong>Page</strong>'
			);
			echo '<br/>';
				esc_html_e( 'Usually, it is the Post Edit page (post.php) or the Settings page.', 'wpglobus-plus' );
			echo '<br/>';
			printf( // translators: %1 - wpml-config.xml.
				esc_html__( 'If your active theme has a configuration file %1$s and has some fields in the admin area that you need to translate, then you can get hints from that file.', 'wpglobus-plus' ),
				'<strong>wpml-config.xml</strong>'
			);
			echo ' ';
			printf( // translators: %1 - admin-texts, %2 - custom-fields.
				esc_html__( 'Look for the %1$s and %2$s sections in the configuration file ', 'wpglobus-plus' ),
				'<strong>admin-texts</strong>',
				'<strong>custom-fields</strong>'
			);
			printf( // translators: %1 - WPGlobus, %2 - URL.
				esc_html__( 'on the %1$s settings page, use %2$sthis link%3$s to view the configuration file if your theme has it.', 'wpglobus-plus' ),
				'<strong>WPGlobus</strong>',
				'<a href="' . esc_url( $_url ) . '" target="_blank">',
				'</a>'
			);
			echo '</p>';
		}

		/**
		 * Displays the bulk actions dropdown.
		 *
		 * @since 1.4.5
		 *
		 * @param string $which The location of the bulk actions: 'top' or 'bottom'.
		 *                      This is designated as optional for backward compatibility.
		 */
		protected function bulk_actions( $which = '' ) {

			if ( 'bottom' === $which ) {
				return;
			}

			if ( empty( $this->options['page_list'] ) || count( $this->options['page_list'] ) < 2 ) {
				/**
				 * Don't output dropdown select.
				 */
				return;
			}

			if ( is_null( $this->_actions ) ) {
				$this->_actions = $this->get_bulk_actions();
				$two = '';
			} else {
				$two = '2';
			}

			if ( empty( $this->_actions ) ) {
				return;
			}

			$_filter_link = add_query_arg(
				array(
					'page'   => WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
					'tab'    => self::TAB,
					'filter' => $this->get_filter(),
				),
				admin_url( 'admin.php' )
			);
			
			echo '<label for="action-filter-' . esc_attr( $which ) . '" class="alignleft" style="margin-top:5px;margin-right:10px;font-weight:600;">';
			echo esc_html__( 'The elements displayed are for', 'wpglobus-plus' );
			echo ' :</label>';
			echo '<select name="action-filter-' . esc_attr( $which ) . '" id="action-filter-' . esc_attr( $which ) . "\">\n";
			echo '<option value="-1">' .
				 esc_html__( 'Select a page', 'wpglobus-plus' ) .
				 "</option>\n";

			foreach ( $this->_actions as $action_name=>$title ) {
	
				$_filter_link = add_query_arg(
					array(
						'page'   => WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
						'tab'    => self::TAB,
						'filter' => $action_name,
					),
					admin_url( 'admin.php' )
				);

				$_selected = '';

				if ( $action_name === $this->get_filter() ) {
					$_selected = ' selected ';
				}
				
				$class = 'edit' === $action_name ? ' class="hide-if-no-js"' : '';

				echo "\t" . '<option value="' . $action_name . '"' . $class . $_selected . ' data-filter-link="' . $_filter_link . '">' . $title . "</option>\n";
			}

			echo "</select>\n";
			echo '<a onclick="return false;" href="#" class="wpglobus-plus-wpglobeditor-filter-button button action">' . __( 'Filter' ) . '</a>';
			echo "\n";
		}

		/**
		 * Gets the list of bulk actions available on this table.
		 *
		 * The format is an associative array:
		 * - `'option_name' => 'option_title'`
		 *
		 * @since 1.4.5
		 *
		 * @return array
		 */		
		protected function get_bulk_actions() {
			
			if ( empty( $this->options['page_list'] ) ) {
				return array();
			}
			
			$_actions = array();
			
			foreach( $this->options['page_list'] as $page=>$attrs ) {
				$_actions[$page] = $page;
			}
			
			if ( count( $_actions ) > 1 ) {
				$_actions[ self::ALL_PAGES ] = ' -- ' .
											   esc_html__( 'All pages', 'wpglobus-plus' ) .
											   ' -- ';
			}
			
			return $_actions;
		}		
		
		/**
		 * Displays the table.
		 *
		 * @since 1.4.5
		 *
		 * @param string $which
		 */
		public function display( $which = 'standard_table' ) {
			
			$singular = $this->_args['singular'];
			
			if ( 'standard_table' === $which ) {	

				$this->display_tablenav( 'top' );
				$this->screen->render_screen_reader_content( 'heading_list' );
				?>
<table class="wp-list-table <?php echo implode( ' ', $this->get_table_classes() ); ?>">
	<thead>
	<tr>
		<?php $this->print_column_headers(); ?>
	</tr>
	</thead>

	<tbody id="the-list"
		<?php
		if ( $singular ) {
			echo " data-wp-lists='list:$singular'";
		}
		?>
		>
		<?php $this->display_rows_or_placeholder(); ?>
	</tbody>

	<tfoot>
	<tr>
		<?php $this->print_column_headers( false ); ?>
	</tr>
	</tfoot>

</table><?php
				$this->display_tablenav( 'bottom' );
				
			} else {	?>
<table class="wp-list-table <?php echo implode( ' ', $this->get_table_classes() ); ?>">
	<thead>
	<tr>
		<?php $this->print_column_headers(); ?>
	</tr>
	</thead>

	<tbody id="the-list"
		<?php
		if ( $singular ) {
			echo " data-wp-lists='list:$singular'";
		}
		?>
		>
		<?php $this->display_rows_or_placeholder(); ?>
	</tbody>

	<tfoot>
	<tr>
		<?php $this->print_column_headers( false ); ?>
	</tr>
	</tfoot>

</table><?php

			}				
		}
	} // class WPGlobusPlus_Editor_Table.

endif;

# --- EOF
