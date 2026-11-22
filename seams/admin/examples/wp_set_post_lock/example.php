<?php
// Marks the current user as editing a post, storing the time and user in _edit_lock; gives the lock as time and user.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$lock = wp_set_post_lock( $post );
return array( $lock[1], get_post_meta( $post, '_edit_lock', true ) === implode( ':', $lock ) );
