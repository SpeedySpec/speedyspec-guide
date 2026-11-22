<?php
// Removes an attachment from the cache, its terms too with clean_terms; fires clean_attachment_cache.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
clean_attachment_cache( $att );
return did_action( 'clean_attachment_cache' );
