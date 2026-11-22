<?php
// The old media dialog's form rows for every attachment of a post.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg', 'post_parent' => $post ), 'lake.jpg' );
return str_contains( get_media_items( $post, null ), 'Lake' );
