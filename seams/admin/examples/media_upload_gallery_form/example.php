<?php
// Prints the old media dialog's Gallery tab: the attached images and the gallery settings.
$_REQUEST['post_id'] = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
return str_contains( guide_render( fn() => media_upload_gallery_form( null ) ), 'gallery-settings' );
