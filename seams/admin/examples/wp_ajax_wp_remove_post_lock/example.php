<?php
// Ajax handler that releases the user's edit lock on a post when they leave the editor, so others can edit it.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
wp_set_post_lock( $post );
$lock = get_post_meta( $post, '_edit_lock', true );
guide_ajax( 'wp_ajax_wp_remove_post_lock', array( 'post_ID' => $post, 'active_post_lock' => $lock ), "update-post_$post" );
return get_post_meta( $post, '_edit_lock', true ) !== $lock;
