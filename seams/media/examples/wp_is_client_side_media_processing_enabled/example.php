<?php
// Whether the browser processes uploaded images: on HTTPS or localhost, which SharedArrayBuffer needs; filtered by wp_client_side_media_processing_enabled.
$plain = wp_is_client_side_media_processing_enabled();
$_SERVER['HTTP_HOST'] = 'shop.localhost';
return array( $plain, wp_is_client_side_media_processing_enabled() );
