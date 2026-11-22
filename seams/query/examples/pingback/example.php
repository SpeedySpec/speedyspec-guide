<?php
// Sends pingbacks to the links in a post's content that have a pingback server, skipping its own and already pinged URLs; fires pre_ping.
$post = wp_insert_post( array( 'post_title' => 'Links', 'post_status' => 'publish', 'post_content' => '<a href="http://elsewhere.test/a">a</a>' ) );
pingback( get_post( $post )->post_content, $post );
return array( did_action( 'pre_ping' ), get_pung( $post ) );
