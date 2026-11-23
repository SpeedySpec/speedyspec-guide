<?php
// Emails the person who asked their personal data export link, which expires after a few days; true or an error.
$request = wp_create_user_request( 'ada@example.org', 'export_personal_data' );
wp_update_post( array( 'ID' => $request, 'post_status' => 'request-confirmed' ) );
update_post_meta( $request, '_export_file_name', 'export.zip' );
return wp_privacy_send_personal_data_export_email( $request );
