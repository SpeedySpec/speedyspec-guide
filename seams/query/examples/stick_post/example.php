<?php
// Makes a post sticky by adding it to sticky_posts; fires post_stuck.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
stick_post( $id );
return array( get_option( 'sticky_posts' ) === array( $id ), did_action( 'post_stuck' ) );
