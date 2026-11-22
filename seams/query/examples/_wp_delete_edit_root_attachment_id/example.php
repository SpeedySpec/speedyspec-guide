<?php
// Hooked to deleted_post: clears the edit root recorded on copies of an attachment deleted for good, so they don't point at a reused ID.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
$copy = wp_insert_attachment( array( 'post_title' => 'Crop', 'post_mime_type' => 'image/jpeg' ) );
update_post_meta( $copy, '_wp_attachment_edit_root_id', $att );
_wp_delete_edit_root_attachment_id( $att );
return get_post_meta( $copy, '_wp_attachment_edit_root_id' );
