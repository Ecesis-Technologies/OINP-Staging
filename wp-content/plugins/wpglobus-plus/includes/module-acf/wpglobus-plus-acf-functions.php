<?php
/**
 * File: wpglobus-plus-acf-functions.php
 */
/**
 * Filters the ACF field $value after it has been loaded.
 *
 * @since 1.3.5
 *
 * @param mixed  $value The value to preview.
 * @param string $post_id The post ID for this value.
 * @param array  $field The field array.
 */
function filter__wpglobus_plus_acf_load_value($value, $post_id, $field) {

	if ( 'table' == $field['type'] ) {
		/**
		 * @see https://wordpress.org/plugins/advanced-custom-fields-table-field/
		 *
		 * How to output the table html?
		 * @see https://wordpress.org/plugins/advanced-custom-fields-table-field/#how%20to%20output%20the%20table%20html%3F
		 */
		if ( is_string($value) && WPGlobus_Core::has_translations($value) ) {
			$value = WPGlobus_Core::text_filter( $value, WPGlobus::Config()->language );
			$value = maybe_unserialize( $value );
		}
	}	
	
	return $value;
}
/**
 * @see advanced-custom-fields\includes\acf-value-functions.php
 */
add_filter( 'acf/load_value', 'filter__wpglobus_plus_acf_load_value', 5, 3 );

/**
 * Activate wysiwyg field.
 * @since 1.1.42
 *
 * @param boolean $value
 * @return boolean
 */
function filter__wpglobus_plus_acf_field_wysiwyg($value) {
	return true;
}
add_filter( 'wpglobus/vendor/acf/field/wysiwyg', 'filter__wpglobus_plus_acf_field_wysiwyg' );

/**
 * Activate table field.
 * @see https://wordpress.org/plugins/advanced-custom-fields-table-field/
 * @since 1.1.55
 *
 * @param boolean $value
 * @return boolean
 */
function wpglobus_plus_acf_field_table($value) {

	static $_value = null;
	
	if ( is_null($_value) ) {
		/**
		 * @see wpglobus-plus\includes\wpglobus-plus-main.php to get $option_key.
		 */
		$option_key = 'wpglobus_plus_options'; 
		$option 	= (array) get_option($option_key);

		$_value = true;
		if ( isset($option['acf']['active_status']) && ! $option['acf']['active_status'] ) {
			$_value = false;
		}
	}

	return $_value;
}
/**
 * @see wpglobus\includes\vendor\acf\class-wpglobus-acf.php
 * obsolete @since 1.5.6 
 * @todo remove after testing
 */
// add_filter( 'wpglobus/vendor/acf/field/table', 'wpglobus_plus_acf_field_table' );

/**
 * Disable/enable to filter meta field. Case when WPGlobus Plus is active but module ACF Plus is deactivated.
 *
 * @see wpglobus\includes\admin\meta\class-wpglobus-meta.php
 * @since 1.1.45
 *
 * @param string $meta_key Meta key.
 *
 * @return string|boolean Meta key or false if module ACF Plus is deactivated.	
 */
function filter__wpglobus_plus_acf_field_wysiwyg_status($meta_key) {
	
	if ( class_exists('WPGlobusPlus_Acf') ) {
		/**
		 * ACF Plus is active.
		 */
		return $meta_key;
	}
	
	global $post;
	
	if ( class_exists('WPGlobus_Acf_2') ) {
		$fields = WPGlobus_Acf_2::get_acf_fields($post->ID);
		if ( ! empty($fields[$meta_key]) && $fields[$meta_key]['type'] == 'wysiwyg'  ) {
			return false;
		}
	}
	
	return $meta_key;
}
add_filter( 'wpglobus/meta/key', 'filter__wpglobus_plus_acf_field_wysiwyg_status' );

/**
 * @since 1.5.6
 */
function filter__wpglobus_plus_acf_field_types( $field_types, $status ) {

	/**
	 * @see wpglobus-plus\includes\wpglobus-plus-main.php to get $option_key.
	 */
	$option_key = 'wpglobus_plus_options'; 
	$option 	= (array) get_option($option_key);

	if ( isset($option['acf']['active_status']) && ! $option['acf']['active_status'] ) {
		return $field_types;
	}
	
	if ( ! empty( $field_types['wysiwyg'] ) ) {
		$field_types['wysiwyg'] = $status['MULTILINGUAL'];
	}

	/**
	 * Advanced Custom Fields: Table Field.
	 * https://wordpress.org/plugins/advanced-custom-fields-table-field/
	 */
	if ( function_exists('acf_table_load_plugin_textdomain') ) {
		if ( ! empty( $field_types['table'] ) ) {
			$field_types['table'] = $status['MULTILINGUAL'];
		}
	}
	
	return $field_types;
}
add_filter( 'wpglobus_vendor_acf_field_types', 'filter__wpglobus_plus_acf_field_types', 10, 2 );

/**
 * @since 1.8.0
 */
function filter__wpglobus_plus_acf_disabled_entities( $disabled_entities ) {
	
	if ( version_compare( WPGLOBUS_VERSION, '2.8.3', '<' ) ) {
		return $disabled_entities;
	}

	/**
	 * @see wpglobus-plus\includes\wpglobus-plus-main.php to get $option_key.
	 */
	$option_key = 'wpglobus_plus_options'; 
	$option 	= (array) get_option($option_key);

	if ( isset($option['acf']['active_status']) && ! $option['acf']['active_status'] ) {
		return $disabled_entities;
	}
	
	global $pagenow;
	
	if ( $pagenow != 'post.php' ) {
		return $disabled_entities;			
	}
		
	$found = array_search( 'acf-field-group', $disabled_entities );
	if ( $found ) {
		unset( $disabled_entities[$found] );
	}	

	return $disabled_entities;			
}
add_filter( 'wpglobus_disabled_entities', 'filter__wpglobus_plus_acf_disabled_entities' );		

# --- EOF