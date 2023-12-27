<?php
/**
 * File: options.php.
 * @since 1.8.2
 *
 * @package WPGlobus Plus
 * @module Taxonomies.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$reset_action = 'reset';
$rewrite_rules_action = 'rewrite-rules';

$action = WPGlobus_Utils::safe_get('action');

if ( $reset_action === $action ) {
	
	$enabled_post_types = $this->get_enabled_post_types();
	$enabled_taxonomies = $this->get_enabled_taxonomies();
	
	$opts = get_option( $this->option_key );
	
	/**
	 * Post types.
	 */
	if ( empty( $enabled_post_types ) ) {
		$opts['post_type'] = array();
	} else {
		
		foreach( $opts['post_type'] as $post_type=>$data ) {
			if ( ! in_array( $post_type, $enabled_post_types ) ) {
				unset( $opts['post_type'][$post_type]);
				
			}
		}
	}
	
	/**
	 * Taxonomies.
	 */
	if ( empty( $enabled_taxonomies ) ) {
		$opts['taxonomy'] = array();
	} else {
		
		foreach( $opts['taxonomy'] as $taxonomy=>$data ) {
			if ( ! in_array( $taxonomy, $enabled_taxonomies ) ) {
				unset( $opts['taxonomy'][$taxonomy] );
			}
		}
		
	}

	if ( ! empty( $opts['taxonomy'] ) ) {
		$opts['taxonomy'] = $this->clean_up_terms( $opts['taxonomy'] );
	}

	if ( ! empty( $opts['taxonomy'] ) ) {
		$opts['taxonomy_terms_id'] = $this->gather_term_ids( $opts['taxonomy'] );
	}

	update_option( $this->option_key, $opts, false );
	
	$redirect_to = add_query_arg(
		array(
			'page'    => WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
			'tab'     => self::TAB,
			'section' => 'option',
			'action'  => $rewrite_rules_action
		),
		admin_url( 'admin.php' )
	);
	
	wp_redirect( $redirect_to );
	exit;	
	
} else if ( $rewrite_rules_action === $action ) {
	
	flush_rewrite_rules();
	
	$redirect_to = add_query_arg(
		array(
			'page'    => WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
			'tab'     => self::TAB,
			'section' => 'option'
		),
		admin_url( 'admin.php' )
	);
	
	wp_redirect( $redirect_to );
	exit;		
}

$url_reset = add_query_arg(
	array(
		'page'    => WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
		'tab'     => self::TAB,
		'section' => 'option',
		'action'  => $reset_action
	),
	admin_url( 'admin.php' )
);

$url_debug = add_query_arg(
	array(
		'page'    => WPGlobusPlus::WPGLOBUS_PLUS_OPTIONS_PAGE,
		'tab'     => self::TAB,
		'section' => 'debug'
	),
	admin_url( 'admin.php' )
);
?>
<div class="reset-options-box" style="margin-top:20px;">
	<div class="action hiddenZ">
		<div style="font-weight:bold;margin-bottom:10px;"><?php
			esc_html_e( 'Attention!', 'wpglobus-plus' ); ?>
		</div>
		<div style="margin-bottom:10px;"><?php
			$_message1 = esc_html__( 'You can rewrite the Taxonomy Module settings to make them matching %1$s.', 'wpglobus-plus' );
			$_message2 = esc_html__( 'The Post Types and Taxonomies', 'wpglobus-plus' );
			echo sprintf( $_message1, '<a href="'.$url_debug.'">'.$_message2.'</a>' ); 	?>
		</div>
		<div style="margin-bottom:10px;"><?php
			$_message1 = esc_html__( 'If you believe that the settings should be rewritten, click', 'wpglobus-plus' );
			$_message2 = esc_html__( '%1$sRewrite Settings%2$s', 'wpglobus-plus' );
			echo '<span style="height:40px;vertical-align:sub;">'.$_message1.'</span>&nbsp;';
			echo sprintf( $_message2, '<a href="'.$url_reset.'" class="button button-secondary">', '</a>' );	?>
		</div>		
	</div>
</div>
<?php
echo '<h3>' . esc_html( sprintf( __( 'Key: %s', 'wpglobus-plus' ), $this->option_key ) ) . '</h3>';
$opts = get_option( $this->option_key );
if ( $opts ) {
	echo '<pre>' . esc_html( print_r( $opts, true ) ) . '</pre>';
} else {
	esc_html_e( 'Not found in the options table.', 'wpglobus-plus' );
}

# --- EOF
