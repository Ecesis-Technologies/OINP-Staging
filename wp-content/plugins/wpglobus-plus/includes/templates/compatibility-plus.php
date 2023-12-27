<?php
/**
 * File: compatibility-plus.php
 *
 * @package WPGlobus Plus
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Array of supported add-ons.
 */
$add_ons = array();

$add_ons['molongui-authorship'] = array(
	'id' 			  => 'molongui-authorship',
	'role' 			  => 'add-on',
	'admin_bar_label' => '',
	'supported_min_version' => '4.2.0',
	'plugin_name' 			=> 'Molongui Authorship',
    'plugin_uri'			=> 'https://wordpress.org/plugins/molongui-authorship/',
	'path' 					=> 'molongui-authorship/molongui-authorship.php',
	'stage' 				=> 'production',
	'vendor_path'			=> WPGlobusPlus::$VENDOR_DIR_PATH . 'molongui-authorship/',
	'vendor_url'			=> WPGlobusPlus::$VENDOR_DIR_URL . 'molongui-authorship/',
	'vendor_content'		=> 'vendor-content-molongui-authorship.php'
);

/**
 * @since 1.4.1
 */
$add_ons['wpDiscuz'] = array(
	'id' 			  => 'wpDiscuz',
	'role' 			  => 'add-on',
	'admin_bar_label' => '',
	'supported_min_version' => '7.0.7',
	'plugin_name' 			=> 'Comments – wpDiscuz',
    'plugin_uri'			=> 'https://wordpress.org/plugins/wpdiscuz/',
	'path' 					=> 'wpdiscuz/class.WpdiscuzCore.php',
	'stage' 				=> 'production',
	'vendor_path'			=> WPGlobusPlus::$VENDOR_DIR_PATH . 'wpdiscuz/',
	'vendor_url'			=> WPGlobusPlus::$VENDOR_DIR_URL . 'wpdiscuz/',
	'vendor_content'		=> 'vendor-content-wpdiscuz.php'	
);

/**
 * @since 1.4.5
 */
$add_ons['wp-review'] = array(
	'id' 			  => 'wp-review',
	'role' 			  => 'add-on',
	'admin_bar_label' => '',
	'supported_min_version' => '5.3.4',
	'plugin_name' 			=> 'WP Review',
    'plugin_uri'			=> 'https://wordpress.org/plugins/wp-review/',
	'path' 					=> 'wp-review/wp-review.php',
	'stage' 				=> 'production',
	'vendor_path'			=> WPGlobusPlus::$VENDOR_DIR_PATH . 'wp-review/',
	'vendor_url'			=> WPGlobusPlus::$VENDOR_DIR_URL . 'wp-review/',
	'vendor_content'		=> 'vendor-content-wp-review.php'	
);


foreach ( $add_ons as $_id=>$add_on ) {

	$_file = WP_PLUGIN_DIR . '/' . $add_on['path'];

	$add_ons[$_id]['version'] = '';
	$_status  = '';
	if ( file_exists( $_file ) ) {

		$_fd = get_file_data( $_file, array( 'version' => 'Version' ) );

		if ( is_plugin_active( $add_on['path'] ) ) {
			$_status = esc_html__( 'Active', 'wpglobus' );
		} else {
			$_status = esc_html__( 'Installed, inactive', 'wpglobus' );
		}

		/**
		 * Set current add-on's version.
		 */
		$add_ons[$_id]['version'] = empty($_fd['version']) ? '' : $_fd['version'];		
	} else {
		$_status = esc_html__( 'Not installed', 'wpglobus' );
	}

	/**
	 * Set current add-on's status.
	 */
	$add_ons[$_id]['status'] = $_status;
	
	/**
	$_stage = '';
	if ( empty( $add_on['stage'] ) ) {
		$_stage = 'production';
	} else {
		if ( 'beta' === $add_on['stage'] ) {
			if ( ! empty( $add_on['beta_version'] ) ) {
				$_stage = $add_on['stage'] . '-' . $add_on['beta_version'];
			} else {
				$_stage .= $add_on['stage'];
			}
			$_stage .= ' *)';
		} else {
			$_stage = $add_on['stage'];
		}
	}
	// */
}
ob_start();
?>
<div class="wpglobus-options-wrap" style="grid-template-columns: 25% 75%;">
	<div class="wpglobus-options-sidebar wpglobus-options-wrap__item">
		<ul class="wpglobus-options-menu">
			<?php foreach ( $add_ons as $id=>$add_on ) : ?>
				<li id="wpglobus-tab-link-subsection-<?php echo esc_attr( $id ); ?>"
						class="wpglobus-tab-link-subsection" 
						data-tab="<?php echo esc_attr( $id ); ?>">
					<a href="#" class="no-inline-js" 
						data-tab="<?php echo esc_attr( $id ); ?>">
						<span class="group_title-subsection"><?php echo esc_html( $add_on['plugin_name'] ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div><!-- sidebar -->
	<div class="wpglobus-options-main wpglobus-options-wrap__item">
		<div class="wpglobus-options-info">
			<?php foreach ( $add_ons as $id=>$add_on ) : ?>
				<div id="subsection-tab-<?php echo esc_attr( $id ); ?>"
						class="wpglobus-options-tab wpglobus-options-tab-subsection"
						data-tab="<?php echo esc_attr( $id ); ?>">
					<?php if ( empty( $add_on['plugin_name'] ) ) { ?>
						<h2><?php echo "Plugin"; ?></h2>
					<?php } else { ?>
						<h2><?php echo esc_html( $add_on['plugin_name'] ); ?></h2>
					<?php } ?>
					<?php
						esc_html_e( 'Plugin URI', 'wpglobus-plus' );
						echo ': ' . '<a href="'.$add_on['plugin_uri'].'" target="_blank">' . $add_on['plugin_uri'] . '</a>';
						echo  '<br />';
						esc_html_e( 'Current version', 'wpglobus' );
						echo ': <strong>' . $add_on['version'] . '</strong>';
						echo  '<br />';
						esc_html_e( 'Supported minimum version', 'wpglobus' );
						echo ': <strong>' . $add_on['supported_min_version'] . '</strong>';
						echo  '<br />';
						esc_html_e( 'Status', 'wpglobus' );
						echo ': <strong>' . $add_on['status'] . '</strong>';
						echo  '<hr />';						
						if ( ! empty( $add_on['vendor_path'] ) && ! empty( $add_on['vendor_content'] ) ) {
							if ( file_exists( $add_on['vendor_path'] . $add_on['vendor_content'] ) ) {
								include_once $add_on['vendor_path'] . $add_on['vendor_content'];
							}
						}
					?>
				</div><!-- .wpglobus-options-tab -->
			<?php endforeach; ?>
		</div><!-- .wpglobus-options-info -->
	</div><!-- .wpglobus-options-main -->	
</div><!-- .wpglobus-options-wrap -->
<?php
$compatibility = ob_get_clean();

return $compatibility;

# --- EOF
