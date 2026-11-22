<?php
// The number of a post type's posts by status, as an object; readable adds the user's private posts; filtered by wp_count_posts.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_insert_post( array( 'post_title' => 'D' ) );
$counts = wp_count_posts();
return array( $counts->publish, $counts->draft, $counts->trash );
