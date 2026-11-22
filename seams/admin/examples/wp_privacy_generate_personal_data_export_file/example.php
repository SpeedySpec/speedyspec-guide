<?php
// Builds a personal data export as a ZIP of an HTML and a JSON file in the exports folder, from the data the exporters gathered, and stores its name on the request.
$request = wp_create_user_request( 'ada@example.org', 'export_personal_data' );
wp_update_post( array( 'ID' => $request, 'post_status' => 'request-confirmed' ) );
update_post_meta( $request, '_export_data_raw', array( array( 'group_id' => 'user', 'group_label' => 'User', 'item_id' => 'user-1', 'data' => array( array( 'name' => 'Email', 'value' => 'ada@example.org' ) ) ) ) );
update_post_meta( $request, '_export_data_grouped', array( 'user' => array( 'group_label' => 'User', 'items' => array( 'user-1' => array( array( 'name' => 'Email', 'value' => 'ada@example.org' ) ) ) ) ) );
wp_privacy_generate_personal_data_export_file( $request );
$name = get_post_meta( $request, '_export_file_name', true );
$folder = wp_privacy_exports_dir();
$made = file_exists( $folder . $name );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( $folder, true );
return array( $made, str_ends_with( $name, '.zip' ) );
