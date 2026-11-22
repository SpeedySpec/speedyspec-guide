<?php
// Queries for a published post and stores the Calendar block's has-posts flag.
wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
return array( block_core_calendar_update_has_published_posts(), get_option( 'wp_calendar_block_has_published_posts' ) );
