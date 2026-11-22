<?php
// Deletes an object's meta for a key, only rows with a value when given; with $delete_all, the key on every object. delete_{$meta_type}_metadata can answer first; delete_ and deleted_{$meta_type}_meta fire.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
$other = wp_insert_post( array( 'post_title' => 'B', 'post_status' => 'publish' ) );
add_metadata( 'post', $post, 'tag', 'a' );
add_metadata( 'post', $post, 'tag', 'b' );
add_metadata( 'post', $other, 'tag', 'a' );
$one = delete_metadata( 'post', $post, 'tag', 'a' );
$all = delete_metadata( 'post', 0, 'tag', 'a', true );
return array( $one, get_metadata( 'post', $post, 'tag' ), $all, get_metadata( 'post', $other, 'tag' ), delete_metadata( 'post', $post, 'none' ) );
