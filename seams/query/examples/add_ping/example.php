<?php
// Adds URLs to a post's pinged list; filtered by add_ping.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
add_ping( $id, 'http://a.test/' );
add_ping( $id, array( 'http://b.test/' ) );
return get_pung( $id );
