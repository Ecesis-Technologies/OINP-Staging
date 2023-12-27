<?php
/**
 * Module WPGlobus Editor.
 *
 * @since 1.1.38
 * @since 1.4.0  Don't include User meta to $multilingual_meta_keys array.
 *
 * @package WPGlobus Plus
 * @scope front
 */
add_filter( 'wpglobus_multilingual_meta_keys', 'filter__wpglobus_plus_multilingual_meta_keys', 5 );
function filter__wpglobus_plus_multilingual_meta_keys($multilingual_meta_keys) {

	$options = get_option('wpglobus_plus_wpglobeditor');

	if ( empty($options) || empty($options['page_list']) ) {
		return $multilingual_meta_keys;
	}

	foreach( $options['page_list'] as $page=>$metas ) {
		
		/**
		 * Don't include User meta to $multilingual_meta_keys array.
		 * @since 1.4.0
		 */
		if ( defined('WPGlobus::WP_USER_EDIT_PAGE') && WPGlobus::WP_USER_EDIT_PAGE == $page ) { 
			continue;
		}
		
		foreach( $metas as $meta ) {
			$multilingual_meta_keys[$meta] = true;
		}
	}

	return $multilingual_meta_keys;
}

# --- EOF