<?php
// Creates categories by name when missing and assigns them to a post; gives their IDs.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
wp_create_categories( array( 'Green', 'Black' ), $post );
return wp_get_post_categories( $post, array( 'fields' => 'names' ) );
