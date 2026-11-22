<?php
// Sends trackbacks for every post with URLs to ping.
$post = wp_insert_post( array( 'post_title' => 'TB', 'post_status' => 'publish', 'to_ping' => 'http://elsewhere.test/trackback' ) );
do_all_trackbacks();
return get_to_ping( $post );
