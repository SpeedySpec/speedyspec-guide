<?php
// Sends a post's trackbacks to the URLs in its to_ping, moving each to pinged; private and password posts send none.
$post = wp_insert_post( array( 'post_title' => 'TB', 'post_status' => 'publish', 'to_ping' => 'http://elsewhere.test/trackback' ) );
do_trackbacks( $post );
return array( get_to_ping( $post ), get_pung( $post ) );
