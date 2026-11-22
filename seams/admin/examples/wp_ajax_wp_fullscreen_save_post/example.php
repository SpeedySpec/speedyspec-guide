<?php
// Ajax handler the old distraction-free editor saved posts with. Deprecated in 4.3.0.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) );
$sent = json_decode( guide_ajax( 'wp_ajax_wp_fullscreen_save_post', array( 'post_ID' => $post, '_wpnonce' => wp_create_nonce( "update-post_$post" ) ) ), true );
return $sent['success'];
