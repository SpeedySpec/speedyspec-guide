<?php
// Sets up the main query from the request: parses it into query variables and runs WP_Query, as WordPress does for each page. Its query variables can be given, as here.
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
wp( array( 'p' => $post ) );
return array( $GLOBALS['wp_query']->is_single, get_the_title( $GLOBALS['wp_query']->post ) );
