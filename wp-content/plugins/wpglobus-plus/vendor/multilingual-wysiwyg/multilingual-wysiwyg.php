<?php
/**
 * File: multilingual-wysiwyg.php
 *
 * @copyright Copyright 2021-2023 Alex Gor
 *
 * 2021-03-17 - version 1.0.0
 *  - The first stable version.
 *
 * 2021-03-20 - version 1.1.0
 *  - Prevent starting if WPGlobusPlus TinyMCE module is active.
 *
 * 2021-04-21 - version 1.2.0
 *  - Prevent multiple script loading.
 *  - Visual improvements.
 *
 * 2021-04-22 - version 1.3.0
 *  - Using setTimeout in attachListeners function.
 * 
 * 2021-06-23 - version 1.4.0
 *  - Added `get_args` function.
 *  - Revised  `is_enabled_current_page` function.
 *  - Revised JS.
 *
 * 2021-06-26 - version 1.5.0
 *  - Revised a result handling of `MultilingualWysiwyg-TinymceEditorInit` trigger.
 *
 * 2023-01-13 - version 1.6.0
 *  - Added `getTinyMCEEditors` function to get previously loaded tinymce editors on page.
 */
 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_admin() ) {
	return;
}

if ( ! defined( 'MULTILINGUAL_WYSIWYG_VERSION' ) ) {
	define( 'MULTILINGUAL_WYSIWYG_VERSION', '1.6.0');
	require_once dirname( __FILE__ ) . '/class-multilingual-wysiwyg.php';
}

# --- EOF