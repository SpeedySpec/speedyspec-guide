<?php
// Prints a list of posts for the Activity widget, by status (published or scheduled), order and number; gives whether there were any.
wp_insert_post( array( 'post_title' => 'Fresh tea', 'post_status' => 'publish' ) );
$found = false;
$html = guide_render( function () use ( &$found ) { $found = wp_dashboard_recent_posts( array( 'max' => 5, 'status' => 'publish', 'order' => 'DESC', 'title' => 'Recently Published', 'id' => 'published-posts' ) ); } );
return array( $found, str_contains( $html, 'Fresh tea' ) );
