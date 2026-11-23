<?php
// The distinct custom field keys in use across all posts.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
add_post_meta( $post, 'origin', 'Fujian' );
return in_array( 'origin', get_meta_keys(), true );
