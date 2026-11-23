<?php
// Ajax handler for exporting a user's personal data: runs a page of one exporter for the request and sends the data, then builds the export file when all are done.
$request = wp_create_user_request( 'ada@example.org', 'export_personal_data' );
$sent = json_decode( guide_ajax( 'wp_ajax_wp_privacy_export_personal_data', array( 'id' => $request, 'exporter' => 1, 'page' => 1, 'sendAsEmail' => 'false' ), "wp-privacy-export-personal-data-$request" ), true );
return array( $sent['success'], $sent['data']['done'] ?? null );
