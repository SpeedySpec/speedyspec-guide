<?php
// The WP class handles a request: parse_request() matches the URL against the rewrite rules into query variables, send_headers() sends the headers, query_posts() runs the main query, handle_404() and register_globals() finish; main() does it all.
global $wp;
$id = wp_insert_post( array( 'post_title' => 'Routed', 'post_status' => 'publish' ) );
$wp->add_query_var( 'guide_view' );
$_SERVER['REQUEST_URI'] = "/?p=$id&guide_view=compact";
$_GET = array( 'p' => $id, 'guide_view' => 'compact' );
$wp->main();
return array( $wp->query_vars, $wp->query_string, $GLOBALS['wp_query']->is_single(), $GLOBALS['post']->post_title );
