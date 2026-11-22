<?php
// Requests the home page over https to check it works: a failure, a status other than 200, or a page from elsewhere is an error; pre_wp_get_https_detection_errors can answer instead.
guide_queue_http( "HTTP/1.1 503 Service Unavailable\r\n\r\n" );
$errors = wp_get_https_detection_errors();
add_filter( 'pre_wp_get_https_detection_errors', fn() => new WP_Error( 'forced', 'Forced.' ) );
return array( $errors, Guide_Queue_Transport::$sent[0]['url'], wp_get_https_detection_errors(), wp_is_https_supported() );
