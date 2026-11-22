<?php
// Adds a meta value to a post (to the revision's parent for revisions); unique refuses a second value.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
return array( is_int( add_post_meta( $id, 'color', 'red' ) ), add_post_meta( $id, 'color', 'blue', true ), get_post_meta( $id, 'color' ) );
