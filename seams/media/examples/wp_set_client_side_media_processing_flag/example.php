<?php
// Tells the block editor's script that client-side media processing is on, and whether the browser supports Document-Isolation-Policy.
$_SERVER['HTTP_HOST'] = 'localhost';
wp_set_client_side_media_processing_flag();
return implode( ' ', wp_scripts()->get_data( 'wp-block-editor', 'before' ) );
