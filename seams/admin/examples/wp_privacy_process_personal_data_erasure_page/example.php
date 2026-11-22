<?php
// Hooked to wp_privacy_personal_data_erasure_page: marks the request completed once the last eraser's last page is done.
$request = wp_create_user_request( 'ada@example.org', 'remove_personal_data' );
$response = wp_privacy_process_personal_data_erasure_page( array( 'items_removed' => false, 'items_retained' => false, 'messages' => array(), 'done' => true ), count( apply_filters( 'wp_privacy_personal_data_erasers', array() ) ), 'ada@example.org', 1, $request );
return get_post_status( $request );
