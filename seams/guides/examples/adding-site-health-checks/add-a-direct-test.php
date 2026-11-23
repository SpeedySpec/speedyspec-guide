<?php
// Add a test to Site Health's Status screen: it reports good, recommended or critical, with what to do about it.
// A direct test: Site Health calls it while building the Status screen, and shows its result.
function my_plugin_test_export_folder() {
	$folder = trailingslashit( wp_upload_dir( null, false )['basedir'] ) . 'my-plugin';
	$result = array(
		'label'       => __( 'My Plugin can save exports', 'my-plugin' ),
		'status'      => 'good',
		'badge'       => array( 'label' => __( 'Performance', 'my-plugin' ), 'color' => 'blue' ),
		'description' => '<p>' . esc_html__( 'Reading lists can be exported.', 'my-plugin' ) . '</p>',
		'actions'     => '',
		'test'        => 'my_plugin_export_folder',
	);
	if ( ! wp_is_writable( dirname( $folder ) ) ) {
		$result['status']      = 'recommended';
		$result['label']       = __( 'My Plugin cannot save exports', 'my-plugin' );
		$result['description'] = '<p>' . esc_html__( 'Make the uploads folder writable so reading lists can be exported.', 'my-plugin' ) . '</p>';
	}
	return $result;
}

function my_plugin_add_site_health_tests( $tests ) {
	$tests['direct']['my_plugin_export_folder'] = array(
		'label' => __( 'My Plugin export folder', 'my-plugin' ),
		'test'  => 'my_plugin_test_export_folder',
	);
	return $tests;
}
add_filter( 'site_status_tests', 'my_plugin_add_site_health_tests' );

// The example keeps its uploads in a temporary folder, writable or not as it chooses.
function guide_uploads_in( $base ) {
	$GLOBALS['guide_uploads'] = $base;
	wp_mkdir_p( $base );
}
function guide_temporary_uploads( $dirs ) {
	$dirs['basedir'] = $GLOBALS['guide_uploads'];
	$dirs['path']    = $GLOBALS['guide_uploads'] . $dirs['subdir'];
	return $dirs;
}
add_filter( 'upload_dir', 'guide_temporary_uploads' );

guide_uploads_in( sys_get_temp_dir() . '/guide-uploads-writable' );
$ok = my_plugin_test_export_folder();

$locked = sys_get_temp_dir() . '/guide-uploads-locked';
guide_uploads_in( $locked );
chmod( $locked, 0555 ); // Read-only.
$problem = my_plugin_test_export_folder();
chmod( $locked, 0755 );

return array(
	'writable'  => array( $ok['status'], $ok['label'] ),
	'read-only' => array( $problem['status'], $problem['label'], wp_strip_all_tags( $problem['description'] ) ),
);
