<?php
// Deletes an attachment with its meta, terms, comments and files (trashing it first when media trash is on and not forced); fires delete_attachment.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
$deleted = wp_delete_attachment( $att, true );
return array( $deleted->post_title, get_post( $att ), did_action( 'delete_attachment' ) );
