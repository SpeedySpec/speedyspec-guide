<?php
// Replaces the main query with a new query from arguments; wp_reset_query() puts the original back. Prefer pre_get_posts to change the main query.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

guide_go( '/' );
query_posts( array( 'post_type' => 'page' ) );
$replaced = $GLOBALS['wp_query']->query_vars['post_type'];
wp_reset_query();
return array( $replaced, $GLOBALS['wp_query']->query_vars['post_type'] );
