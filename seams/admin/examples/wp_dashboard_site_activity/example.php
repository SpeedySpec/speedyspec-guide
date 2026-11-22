<?php
// Prints the Activity widget: soon-to-be-published posts, recently published posts and recent comments.
wp_insert_post( array( 'post_title' => 'Fresh tea', 'post_status' => 'publish' ) );
$html = guide_render( 'wp_dashboard_site_activity' );
return array( str_contains( $html, 'Recently Published' ), str_contains( $html, 'Fresh tea' ) );
