<?php
// A post's children (attachments, revisions or any type) by arguments, keyed by ID; as objects, arrays or IDs.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_insert_post( array( 'post_title' => 'Child', 'post_parent' => $id, 'post_type' => 'page', 'post_status' => 'publish' ) );
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_parent' => $id, 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
return array( wp_list_pluck( get_children( array( 'post_parent' => $id, 'post_type' => 'any' ) ), 'post_title' ), wp_list_pluck( get_children( array( 'post_parent' => $id, 'post_type' => 'attachment' ) ), 'post_title' ) );
