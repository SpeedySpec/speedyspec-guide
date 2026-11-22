<?php
// Inserts or updates an attachment post for a file, with its parent and MIME type, storing the file path; fires add_attachment or edit_attachment.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
$post = get_post( $att );
return array( $post->post_type, $post->post_status, get_post_meta( $att, '_wp_attached_file', true ), did_action( 'add_attachment' ) );
