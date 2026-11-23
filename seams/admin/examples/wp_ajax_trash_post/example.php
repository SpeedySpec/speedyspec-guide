<?php
// Ajax handler that moves a post to the Trash, or restores it for the untrash action, answering 1 on success.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
return array( guide_ajax( fn() => wp_ajax_trash_post( 'trash-post' ), array( 'id' => $post ), "trash-post_$post" ), get_post_status( $post ) );
