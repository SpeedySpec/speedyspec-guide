<?php
// Hooked to transition_post_status: on first publish, adds pings and enclosures to do and runs do_pings when needed; updates the last post caches.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
return array( has_action( 'transition_post_status', '_transition_post_status' ), get_post_meta( $id, '_pingme', true ), get_post_meta( $id, '_encloseme', true ) );
