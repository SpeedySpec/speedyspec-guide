<?php
// Hooked to transition_post_status: refreshes the Calendar block's has-posts flag when a post enters or leaves publish.
update_option( 'wp_calendar_block_has_published_posts', 0 );
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'draft' ) );
wp_update_post( array( 'ID' => $id, 'post_status' => 'publish' ) );
block_core_calendar_update_has_published_post_on_transition_post_status( 'publish', 'draft', get_post( $id ) );
return get_option( 'wp_calendar_block_has_published_posts' );
