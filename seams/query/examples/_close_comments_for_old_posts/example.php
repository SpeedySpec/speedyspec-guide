<?php
// Hooked to the_posts: on a single view, shows comments and pings closed on posts older than close_comments_days_old when close_comments_for_old_posts is on.
update_option( 'close_comments_for_old_posts', 1 );
update_option( 'close_comments_days_old', 14 );
$old = wp_insert_post( array( 'post_title' => 'Old', 'post_status' => 'publish', 'post_date' => '2020-01-01 00:00:00' ) );
$q = new WP_Query( array( 'p' => $old ) );
$posts = _close_comments_for_old_posts( $q->posts, $q );
return array( $posts[0]->comment_status, $posts[0]->ping_status );
