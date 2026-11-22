<?php
// Prints the pingback link in the head on single posts that accept pings; on wp_head.
guide_theme( 'twentynineteen' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
return guide_render( 'twentynineteen_pingback_header' );
