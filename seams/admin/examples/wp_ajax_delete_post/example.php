<?php
// Ajax handler that deletes a post from a list with wp_delete_post(), which moves it to the Trash unless the Trash is off; answers 1 on success.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
return array( guide_ajax( fn() => wp_ajax_delete_post( 'delete-post' ), array( 'id' => $post ), "delete-post_$post" ), get_post_status( $post ) );
