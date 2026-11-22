<?php
// The Continue reading link for the more tag, to the post's #more anchor, outside the admin; on the_content_more_link.
guide_theme( 'twentytwentyone' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
return twenty_twenty_one_continue_reading_link();
