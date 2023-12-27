<?php
/**
 * File: vendor-content-molongui-authorship.php
 *
 * @since   1.4.0
 *
 * @package WPGlobus-Plus
 * @global array $add_on
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$_url = add_query_arg(
	array(
		'page' => WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
		'tab'  => 'wpglobeditor',
	),
	admin_url( 'admin.php' )
);

$_str1 = sprintf( // translators: %1$s, %2$s are placeholders for the A tag.
	esc_html__( 'go to the %1$sEditor Settings%2$s page', 'wpglobus-plus' ),
	'<a href="' . $_url . '" target="_blank">',
	'</a>'
);
$_str2 = sprintf( // translators: %1$s, %2$s are placeholders for non-translatable texts.
	esc_html__( 'add the %2$s and %3$s element names for the %1$s Page - see the screenshot below:', 'wpglobus-plus' ),
	'<strong>user-edit.php</strong>',
	'<strong>description</strong>',
	'<strong>molongui_author_company</strong>'
);
?>
	<p>
		<?php esc_html_e( 'WPGlobus Plus supports multilingual Author Boxes', 'wpglobus-plus' ); ?>
	</p>
	<p>
		<?php esc_html_e( 'To enable multilingual editing on the Edit User pages, you need to:', 'wpglobus-plus' ); ?>
	</p>
	<p>
		- <?php echo $_str1; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</p>
	<p>
		- <?php echo $_str2; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</p>
	<div class="img-container" style="vertical-align:middle;text-align:center;">
		<img style="max-width:100%;max-height:100%;margin-top:1em;"
				src="<?php echo esc_url( $add_on['vendor_url'] ); ?>editor-settings-example.jpg" alt=""/>
	</div>
	<br/>
<?php
# --- EOF
