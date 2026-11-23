<?php
// Ajax handler that sends the Featured image box's HTML for a post and an attachment, without saving.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
$sent = json_decode( guide_ajax( 'wp_ajax_get_post_thumbnail_html', array( 'post_id' => $post, 'thumbnail_id' => -1 ), "update-post_$post" ), true );
return array( $sent['success'], str_contains( $sent['data'], 'set-post-thumbnail' ) );
