<?php
// Site Health gathers every test, WordPress's and plugins', through site_status_tests; direct ones run in the page.
require_once ABSPATH . 'wp-admin/includes/class-wp-site-health.php'; // Loaded by the Site Health screen.
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

$tests = WP_Site_Health::get_tests();
return array(
	'kinds'              => array_keys( $tests ),
	'ours is direct'     => isset( $tests['direct']['my_plugin_export_folder'] ),
	'its label'          => $tests['direct']['my_plugin_export_folder']['label'],
	'an async core test' => isset( $tests['async']['background_updates'] ),
);
