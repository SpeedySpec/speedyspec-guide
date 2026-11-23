<?php
// Runs the main query for the media library list, giving the MIME types and those in use.
wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), 'lake.jpg' );
list( $mime_types, $avail_mime_types ) = wp_edit_attachments_query( array() );
return array( isset( $mime_types['image'] ), $GLOBALS['wp_query']->found_posts );
