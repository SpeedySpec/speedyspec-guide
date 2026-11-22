<?php
// An attachment's caption, its excerpt; filtered by wp_get_attachment_caption.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_excerpt' => 'A sunset', 'post_mime_type' => 'image/jpeg' ) );
return array( wp_get_attachment_caption( $att ), wp_get_attachment_caption( 999 ) );
