<?php
// Whether the site has any published posts, from a cached flag, so the Calendar block can render nothing.
wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
delete_option( 'wp_calendar_block_has_published_posts' );
return array( block_core_calendar_has_published_posts(), get_option( 'wp_calendar_block_has_published_posts' ) );
