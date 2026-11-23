<?php
// Prints the At a Glance widget: counts of posts, pages and comments, the WordPress version and theme, and the search engines notice.
wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$html = guide_render( 'wp_dashboard_right_now' );
return array( str_contains( $html, 'post-count' ), str_contains( $html, 'theme' ) );
