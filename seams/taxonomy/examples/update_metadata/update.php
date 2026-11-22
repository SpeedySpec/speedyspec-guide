<?php
// Updates an object's meta, adding it when missing; with a previous value, only rows with that value. Returns true, the new meta ID, or false when nothing changed. update_{$meta_type}_metadata can answer first; update_ and updated_{$meta_type}_meta fire.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
add_metadata( 'post', $post, 'size', 'S' );
add_metadata( 'post', $post, 'size', 'M' );
$prev = update_metadata( 'post', $post, 'size', 'L', 'M' );
$same = update_metadata( 'post', $post, 'size', 'L', 'M' );
$new = update_metadata( 'post', $post, 'weight', 5 );
return array( $prev, get_metadata( 'post', $post, 'size' ), $same, is_int( $new ), update_metadata( 'post', $post, 'weight', 5 ) );
