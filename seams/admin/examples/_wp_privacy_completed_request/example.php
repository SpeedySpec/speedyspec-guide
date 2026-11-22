<?php
// Marks a privacy request completed, recording the time; gives its ID or an error.
$request = wp_create_user_request( 'ada@example.org', 'export_personal_data' );
_wp_privacy_completed_request( $request );
return get_post_status( $request );
