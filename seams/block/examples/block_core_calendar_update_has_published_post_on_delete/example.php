<?php
// Hooked to delete_post: refreshes the Calendar block's has-posts flag when a published post is deleted.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
update_option( 'wp_calendar_block_has_published_posts', 1 );
wp_delete_post( 1, true );
wp_delete_post( $id, true );
block_core_calendar_update_has_published_post_on_delete( $id );
return get_option( 'wp_calendar_block_has_published_posts' );
