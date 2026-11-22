<?php
// Adds trackback URLs, separated by spaces, to a post's to-ping list and sends them.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
trackback_url_list( 'http://elsewhere.test/tb', $id );
return array( get_to_ping( $id ), get_pung( $id ) );
