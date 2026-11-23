<?php
// The title, caption, description and URL a cropped image takes over from the image it was cropped from, for a context such as site-icon.
$parent = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_excerpt' => 'A calm lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
$props = wp_copy_parent_attachment_properties( '/x/cropped-lake.jpg', $parent, 'site-icon' );
return array( $props['post_title'], $props['post_excerpt'], $props['context'] );
