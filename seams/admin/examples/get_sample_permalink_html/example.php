<?php
// The permalink editor's HTML for a post: the link with its editable slug and Edit button.
$GLOBALS['wp_rewrite']->set_permalink_structure( '/%postname%/' );
$post = wp_insert_post( array( 'post_title' => 'Green tea', 'post_status' => 'publish' ) );
return str_contains( get_sample_permalink_html( $post ), 'editable-post-name' );
