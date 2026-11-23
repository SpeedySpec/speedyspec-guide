<?php
// Handles the old media dialog's From Computer and From URL tabs, saving uploads or inserting URLs and printing the form in an iframe.
$_GET['type'] = 'image';
$html = guide_render( 'wp_media_upload_handler' );
return array( str_contains( $html, 'media-upload-form' ), str_contains( $html, '</html>' ) );
