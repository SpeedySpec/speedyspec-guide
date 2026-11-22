<?php
// Saves the current site's published post count to its post_count option.
wp_insert_post( array( 'post_title' => 'Hi', 'post_status' => 'publish' ) );
update_option( 'post_count', 0 );
update_posts_count();
return get_option( 'post_count' );
