<?php
// The number of attachments by MIME type, plus trash; filtered by wp_count_attachments.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
$counts = wp_count_attachments();
return array( $counts->{'image/jpeg'}, $counts->trash );
