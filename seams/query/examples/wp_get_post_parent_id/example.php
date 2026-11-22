<?php
// A post's parent ID, 0 for none, false when the post doesn't exist.
$a = wp_insert_post( array( 'post_title' => 'A', 'post_type' => 'page' ) );
$b = wp_insert_post( array( 'post_title' => 'B', 'post_type' => 'page', 'post_parent' => $a ) );
return array( wp_get_post_parent_id( $b ) === $a, wp_get_post_parent_id( $a ), wp_get_post_parent_id( 999 ) );
