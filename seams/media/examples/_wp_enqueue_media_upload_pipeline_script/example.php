<?php
// Enqueues an upload screen's client-side processing script with its settings, only when processing is on and the request is cross-origin isolated.
_wp_enqueue_media_upload_pipeline_script( 'media-new-upload' );
$plain = wp_script_is( 'media-new-upload', 'enqueued' );
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36';
wp_send_document_isolation_policy_header();
_wp_enqueue_media_upload_pipeline_script( 'media-new-upload' );
return array( $plain, wp_script_is( 'media-new-upload', 'enqueued' ) );
