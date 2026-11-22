<?php
// Adds tags to a post, keeping its existing ones.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_set_post_tags( $id, 'red' );
wp_add_post_tags( $id, 'blue' );
return wp_get_post_tags( $id, array( 'fields' => 'names' ) );
