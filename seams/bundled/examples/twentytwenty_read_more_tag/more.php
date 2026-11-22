<?php
// Wraps the read more link's text in a button and adds the post's title for screen readers; on the_content_more_link.
guide_theme( 'twentytwenty' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
return twentytwenty_read_more_tag( '<a href="#more" class="more-link">Continue reading</a>' );
