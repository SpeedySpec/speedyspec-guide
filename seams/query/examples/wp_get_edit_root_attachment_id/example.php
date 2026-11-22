<?php
// The attachment an image's chain of edits started from, stored on each edited copy; 0 for uploads that weren't made by editing.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
$copy = wp_insert_attachment( array( 'post_title' => 'Crop', 'post_mime_type' => 'image/jpeg' ) );
update_post_meta( $copy, '_wp_attachment_edit_root_id', $att );
return array( wp_get_edit_root_attachment_id( $copy ) === $att, wp_get_edit_root_attachment_id( $att ) );
