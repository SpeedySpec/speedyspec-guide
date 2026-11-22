<?php
// Puts the main query back after query_posts(), and resets the global post.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

guide_go( "/?p=$id" );
query_posts( 'post_type=page' );
wp_reset_query();
return array( $GLOBALS['wp_query'] === $GLOBALS['wp_the_query'], is_single() );
