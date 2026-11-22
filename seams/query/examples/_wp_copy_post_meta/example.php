<?php
// Adds one meta key's values from a post to another, alongside the values it already had.
$a = wp_insert_post( array( 'post_title' => 'A' ) );
$b = wp_insert_post( array( 'post_title' => 'B' ) );
add_post_meta( $a, 'tag', 'x' );
add_post_meta( $a, 'tag', 'y' );
add_post_meta( $b, 'tag', 'old' );
_wp_copy_post_meta( $a, $b, 'tag' );
return get_post_meta( $b, 'tag' );
