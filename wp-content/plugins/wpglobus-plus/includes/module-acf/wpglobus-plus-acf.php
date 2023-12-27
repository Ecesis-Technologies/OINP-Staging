<?php
/**
 * File: wpglobus-plus-acf.php
 * 
 * Module Acf
 *
 * @since 1.0.0
 *
 * @package WPGlobusPlus
 * @subpackage Administration
 */
 
if ( WPGlobus::O()->vendors_scripts['ACF'] || WPGlobus::O()->vendors_scripts['ACFPRO'] ) {
	require_once( "class-wpglobus-plus-acf.php" );	
	$WPGlobusPlus_Acf = new WPGlobusPlus_Acf();
	
	/**
	 * @since 1.7.2
	 */
	require_once( 'class-wpglobus-plus-acf-options.php' );
	WPGlobusPlus_Acf_Options::get_instance();	
}

# --- EOF