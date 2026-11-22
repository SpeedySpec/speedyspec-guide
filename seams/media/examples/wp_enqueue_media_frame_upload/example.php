<?php
// Enqueues the media modal's client-side upload processing script when the request allows it.
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36';
wp_send_document_isolation_policy_header();
wp_enqueue_media_frame_upload();
return wp_script_is( 'media-frame-upload', 'enqueued' );
