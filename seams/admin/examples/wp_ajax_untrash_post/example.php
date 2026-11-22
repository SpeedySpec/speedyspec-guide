<?php
// Ajax handler that restores a post from the Trash, answering 1 on success.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
wp_trash_post( $post );
return array( guide_ajax( fn() => wp_ajax_untrash_post( 'untrash-post' ), array( 'id' => $post ), "untrash-post_$post" ), get_post_status( $post ) );
