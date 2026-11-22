<?php
// The URLs a post has pinged; filtered by get_pung.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
add_ping( $id, 'http://a.test/' );
return get_pung( $id );
