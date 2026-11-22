<?php
// The ID of the attachment whose file is at a URL in the uploads folder, or 0; filtered by attachment_url_to_postid.
$id = guide_attachment();
update_post_meta( $id, '_wp_attached_file', '2026/11/photo.jpg' );
return array( attachment_url_to_postid( wp_get_attachment_url( $id ) ) === $id, attachment_url_to_postid( 'http://example.org/nope.jpg' ) );
