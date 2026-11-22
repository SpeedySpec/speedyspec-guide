<?php
// Prints a link to a post's comments feed; filtered by post_comments_feed_link_html.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
return guide_render( fn() => post_comments_feed_link( 'Comments feed', $id ) );
