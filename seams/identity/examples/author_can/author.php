<?php
// Whether a post's author has a capability.
$grace = guide_user();
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_author' => $grace ) );
return array( author_can( $post, 'edit_posts' ), author_can( $post, 'manage_options' ), author_can( 999, 'read' ) );
