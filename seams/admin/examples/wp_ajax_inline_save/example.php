<?php
// Ajax handler for Quick Edit in the posts list: saves the post's changes and prints its updated row.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
guide_ajax( 'wp_ajax_inline_save', array( 'post_ID' => $post, 'post_type' => 'post', 'post_title' => 'Green tea', 'post_name' => 'green-tea', '_status' => 'publish', 'screen' => 'edit-post', '_inline_edit' => wp_create_nonce( 'inlineeditnonce' ) ) );
return get_the_title( $post );
