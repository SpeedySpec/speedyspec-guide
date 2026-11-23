<?php
// The fields the media modal and dialog show for an attachment (title, caption, description, alt, URL, taxonomies), as filtered by attachment_fields_to_edit.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
return array_keys( get_attachment_fields_to_edit( get_post( $id ) ) );
