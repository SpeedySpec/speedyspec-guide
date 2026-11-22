<?php
// Hooked to wp_privacy_personal_data_export_page: keeps each exporter page's data, and builds and sends or offers the export file when the last is done.
$request = wp_create_user_request( 'ada@example.org', 'export_personal_data' );
$response = wp_privacy_process_personal_data_export_page( array( 'data' => array(), 'done' => false ), 1, 'ada@example.org', 1, $request, false, 'wordpress-user' );
return $response['done'];
