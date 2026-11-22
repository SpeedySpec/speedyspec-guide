<?php
// The URLs a post still has to ping; filtered by get_to_ping.
$id = wp_insert_post( array( 'post_title' => 'T', 'to_ping' => "http://a.test/\nhttp://b.test/" ) );
return get_to_ping( $id );
