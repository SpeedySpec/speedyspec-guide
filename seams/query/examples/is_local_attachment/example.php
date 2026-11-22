<?php
// Whether a URL is an attachment page of this site.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
return array( is_local_attachment( get_attachment_link( $att ) ), is_local_attachment( 'http://elsewhere.test/?attachment_id=1' ) );
