<?php
// Prints the attachment edit screen's Save box: the upload date and the Update and Delete buttons.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), 'lake.jpg' );
return str_contains( guide_render( fn() => attachment_submit_meta_box( get_post( $id ) ) ), 'id="submitpost"' );
