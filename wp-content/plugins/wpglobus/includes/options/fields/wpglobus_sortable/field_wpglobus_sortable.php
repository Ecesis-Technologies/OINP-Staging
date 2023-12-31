<?php
/**
 * File: field_wpglobus_sortable.php
 *
 * @package     WPGlobus\Admin\Options\Field
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WPGlobusOptions_wpglobus_sortable' ) ) {
	/**
	 * Class WPGlobusOptions_wpglobus_sortable.
	 */
	// phpcs:ignore PEAR.NamingConventions
	class WPGlobusOptions_wpglobus_sortable {

		/**
		 * Field
		 *
		 * @var array
		 */
		private $field;

		/**
		 * Value
		 *
		 * @var string
		 */
		private $value;

		/**
		 * Field Constructor.
		 *
		 * @param array        $field
		 * @param string|array $value
		 */
		public function __construct( $field = array(), $value = '' ) {

			$this->field = $field;
			if ( ! empty( $field['value'] ) ) {
				$this->value = $field['value'];
			} else {
				$this->value = $value;
			}

			$this->render();
		}

		/**
		 * Field Render Function.
		 * Takes the vars and outputs the HTML for the field in the settings.
		 */
		public function render() {
			if ( empty( $this->field['mode'] ) ) {
				$this->field['mode'] = 'text';
			}

			if ( 'checkbox' !== $this->field['mode'] && 'text' !== $this->field['mode'] ) {
				$this->field['mode'] = 'text';
			}

			$field_class = ( isset( $this->field['class'] ) ) ? $this->field['class'] : '';
			$options     = $this->field['options'];

			// This is to weed out missing options that might be in the default
			// Why?  Who knows.  Call it a dummy check.
			if ( ! empty( $this->value ) ) {
				foreach ( $this->value as $k => $v ) {
					if ( ! isset( $options[ $k ] ) ) {
						unset( $this->value[ $k ] );
					}
				}
			}

			$noSort = false;
			foreach ( $options as $k => $v ) {
				if ( ! isset( $this->value[ $k ] ) ) {

					// A save has previously been done.
					if ( is_array( $this->value ) && array_key_exists( $k, $this->value ) ) {
						$this->value[ $k ] = $v;

						// Missing database entry, meaning no save has yet been done.
					} else {
						$noSort            = true;
						$this->value[ $k ] = '';
					}
				}
			}

			// If missing database entries are found, it means no save has been done
			// and therefore no sort should be done.  Set the default array in the same
			// order as the options array.  Why?  The sort order is based on the
			// saved default array.  If entries are missing, the sort is messed up.
			// - kp
			if ( $noSort ) {
				$dummyArr = array();

				foreach ( $options as $k => $v ) {
					$dummyArr[ $k ] = $this->value[ $k ];
				}
				unset( $this->value );
				$this->value = $dummyArr;
				unset( $dummyArr );
			}

			$use_labels  = false;
			$label_class = '';
			if ( 'checkbox' !== $this->field['mode'] ) {
				if ( ( isset( $this->field['label'] ) && true === $this->field['label'] ) ) {
					$use_labels  = true;
					$label_class = ' labeled';
				}
			}

			echo wp_kses_post( $this->render_wrapper( 'before' ) );

			echo '<ul id="' . esc_attr( $this->field['id'] ) . '-list" class="wpglobus-sortable ' . esc_attr( $field_class . ' ' . $label_class ) . '">';

			foreach ( $this->value as $k => $nicename ) {

				$class = $field_class;

				echo '<li class="ui-state-default">';

				$checked = '';
				$name    = 'name="' . $this->field['name'] . $this->field['name_suffix'] . '[' . $k . ']" ';
				if ( 'checkbox' === $this->field['mode'] ) {
					$value_display = $this->value[ $k ];

					if ( ! empty( $this->value[ $k ] ) ) {
						$checked = 'checked="checked" ';
					}
					$class .= ' checkbox_sortable';

					$name = '';
					echo '<input type="hidden" name="'
						 . esc_attr( $this->field['name'] . $this->field['name_suffix'] . '[' . $k . ']' )
						 . '" id="'
						 . esc_attr( $this->field['id'] . '-' . $k ) . '-hidden" value="' . esc_attr( $value_display )
						 . '" />';

					echo '<div class="checkbox-container">';
				} else {
					$value_display = isset( $this->value[ $k ] ) ? $this->value[ $k ] : '';
					$nicename      = $this->field['options'][ $k ];

				}

				if ( 'checkbox' !== $this->field['mode'] ) {
					if ( $use_labels ) {
						echo '<label class="bugger" for="'
							 . esc_attr( $this->field['id'] . '[' . $k . ']' )
							 . '"><strong>'
							 . esc_html( $k )
							 . '</strong></label>';
						echo '<br />';
					}
				}

				echo '<input rel="'
					 . esc_attr( $this->field['id'] . '-' . $k . '-hidden' )
					 . '" class="' . esc_attr( $class ) . '" ';
				echo wp_kses_post( $checked );
				echo 'type="'
					 . esc_attr( $this->field['mode'] )
					 . '" ';
				echo wp_kses_post( $name );
				echo 'id="'
					 . esc_attr( $this->field['id'] . '[' . $k . ']' )
					 . '" value="' . esc_attr( $value_display ) . '" placeholder="' . esc_attr( $nicename ) . '" />';

				//echo '<span class="compact drag"><i class="el el-move icon-large"></i></span>';
				echo '&nbsp;<span class="compact drag"><i class="dashicons dashicons-move icon-large"></i></span>&nbsp;';
				//if ( ( isset( $this->field['label'] ) && $this->field['label'] == true ) ) {
				if ( 'checkbox' === $this->field['mode'] ) {
					// if ( 'checkbox' !== $this->field['mode'] ) {
					//echo "<br />";
					//echo '<label for="' . $this->field['id'] . '[' . $k . ']"><strong>' . $k . '</strong></label>';
					// } else {
					echo '<label for="'
						 . esc_attr( $this->field['id'] . '[' . $k . ']' )
						 . '"><strong>' . esc_html( $options[ $k ] ) . '</strong></label>';
					// }
				}
				if ( 'checkbox' === $this->field['mode'] ) {
					echo '</div>';
				}
				echo '</li>';
			}
			echo '</ul>';

			echo wp_kses_post( $this->render_wrapper( 'after' ) );

		}

		/**
		 * Print DIV around.
		 *
		 * @param string $wrapper
		 *
		 * @return false|string
		 */
		public function render_wrapper( $wrapper = 'before' ) {
			ob_start();

			if ( 'before' === $wrapper ) {
				?>
				<div
				id="wpglobus-options-<?php echo esc_attr( $this->field['id'] ); ?>"
				class="wpglobus-options-field wpglobus-options-field-wpglobus_sortable"
				data-id="<?php echo esc_attr( $this->field['id'] ); ?>"
				data-type="<?php echo esc_attr( $this->field['type'] ); ?>"
				data-js-handler="handler<?php echo esc_attr( ucfirst( $this->field['id'] ) ); ?>">
				<div class="grid__item">
					<p class="title"><?php echo esc_html( $this->field['title'] ); ?></p>
					<p class="subtitle"><?php echo esc_html( $this->field['subtitle'] ); ?></p>
				</div>
				<div class="grid__item">
				<?php
			} elseif ( 'after' === $wrapper ) {
				?>
				</div><!-- .grid__item -->
				</div><!-- .wpglobus-options-field-wpglobus_sortable -->
				<?php
			}

			return ob_get_clean();
		}

	}
}
/**
 * Go
 *
 * @global array $field
 * @see WPGlobus_Options::page_options
 */
new WPGlobusOptions_wpglobus_sortable( $field );
