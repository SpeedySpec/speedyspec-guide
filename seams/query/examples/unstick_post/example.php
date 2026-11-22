<?php
// Removes a post from sticky_posts; fires post_unstuck.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
stick_post( $id );
unstick_post( $id );
return array( get_option( 'sticky_posts' ), did_action( 'post_unstuck' ) );
