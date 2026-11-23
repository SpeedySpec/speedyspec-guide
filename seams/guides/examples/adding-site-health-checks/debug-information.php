<?php
// The Info tab shows each plugin's own section; a private field is shown but left out of the copied report.
require_once ABSPATH . 'wp-admin/includes/class-wp-debug-data.php'; // Loaded by the Site Health screen.

function my_plugin_debug_information( $info ) {
	$info['my-plugin'] = array(
		'label'  => __( 'My Plugin', 'my-plugin' ),
		'fields' => array(
			'db_version' => array(
				'label' => __( 'Database version', 'my-plugin' ),
				'value' => get_option( 'my_plugin_db_version', '1' ),
			),
			'api_key'    => array(
				'label'   => __( 'API key', 'my-plugin' ),
				'value'   => __( 'Set', 'my-plugin' ),
				'private' => true, // Never copied into the report people paste into support forums.
			),
		),
	);
	return $info;
}
add_filter( 'debug_information', 'my_plugin_debug_information' );

$info   = apply_filters( 'debug_information', array() );
$copied = WP_Debug_Data::format( $info, 'debug' );
return array(
	'fields shown'     => array_keys( $info['my-plugin']['fields'] ),
	'copied report'    => trim( $copied ),
);
