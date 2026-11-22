<?php
// Emails the requester that an erasure request is complete, once, for completed erasure requests only.
$request = wp_create_user_request( 'admin@example.org', 'remove_personal_data', array(), 'request-completed' );
_wp_privacy_send_erasure_fulfillment_notification( $request );
return (bool) get_post_meta( $request, '_wp_user_notified', true );
