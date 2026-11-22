<?php
// Runs the main query for a posts list screen from the request (status, order, per page), giving the statuses and their counts.
wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
list( $post_stati, $avail_post_stati ) = wp_edit_posts_query( array( 'post_type' => 'post' ) );
return array( $avail_post_stati, $GLOBALS['wp_query']->found_posts );
