<?php
// Renames the old_slug post meta key of version 2.2 to _wp_old_slug.
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
add_post_meta( $post, 'old_slug', 'hi' );
upgrade_old_slugs();
return array( get_post_meta( $post, 'old_slug', true ), get_post_meta( $post, '_wp_old_slug', true ) );
