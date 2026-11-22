<?php
// A post's status; an attachment or revision with inherit takes its parent's, an orphan attachment is publish; filtered by get_post_status.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
return array( get_post_status( $id ), get_post_status( $att ), get_post_status( 999 ) );
