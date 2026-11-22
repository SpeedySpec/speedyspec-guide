<?php
// Handles the old media dialog's Gallery tab, saving the form and printing the gallery in an iframe.
$_REQUEST['post_id'] = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
$html = guide_render( 'media_upload_gallery' );
return array( str_contains( $html, 'gallery-settings' ), str_contains( $html, '</html>' ) );
