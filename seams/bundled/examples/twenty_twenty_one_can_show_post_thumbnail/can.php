<?php
// Whether the post's thumbnail is shown: it has one, isn't password protected and isn't an attachment; twenty_twenty_one_can_show_post_thumbnail filters it.
guide_theme( 'twentytwentyone' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
$plain = twenty_twenty_one_can_show_post_thumbnail();
add_filter( 'twenty_twenty_one_can_show_post_thumbnail', '__return_true' );
return array( $plain, twenty_twenty_one_can_show_post_thumbnail() );
