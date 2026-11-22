<?php
// Ajax handler for erasing a user's personal data: runs a page of one eraser for the request and sends how many items it removed or kept.
$request = wp_create_user_request( 'ada@example.org', 'remove_personal_data' );
$sent = json_decode( guide_ajax( 'wp_ajax_wp_privacy_erase_personal_data', array( 'id' => $request, 'eraser' => 1, 'page' => 1 ), "wp-privacy-erase-personal-data-$request" ), true );
return array( $sent['success'], array_keys( $sent['data'] ?? array() ) );
