<?php
// Adds the Plupload uploader's defaults (upload URL, file size limit, nonce) to its script as inline settings.
wp_plupload_default_settings();
$data = wp_scripts()->get_data( 'wp-plupload', 'data' );
return array( str_contains( $data, '_wpPluploadSettings' ), str_contains( $data, 'async-upload.php' ) );
