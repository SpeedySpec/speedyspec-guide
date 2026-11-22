<?php
// Sends one trackback with a post's title, excerpt and URL, then moves the URL from to_ping to pinged; the response, or nothing on failure.
$post = wp_insert_post( array( 'post_title' => 'TB', 'post_status' => 'publish' ) );
return trackback( 'http://elsewhere.test/trackback', 'TB', 'Excerpt', $post );
