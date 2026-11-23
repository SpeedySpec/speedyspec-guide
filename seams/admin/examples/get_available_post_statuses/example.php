<?php
// The post statuses wp_count_posts() reports for a post type, including those with no posts.
wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'B', 'post_status' => 'draft' ) );
$statuses = get_available_post_statuses();
sort( $statuses );
return $statuses;
