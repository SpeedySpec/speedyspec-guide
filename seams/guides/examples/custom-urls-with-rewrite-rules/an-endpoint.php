<?php
// add_rewrite_endpoint() adds /reviews/ to the end of every post's URL, and registers the query variable for you.
// The example turns on pretty permalinks, as most sites have them.
global $wp_rewrite;
$wp_rewrite->set_permalink_structure( '/%postname%/' );

// What WordPress does with a request: match it against the rules and collect the query variables.
function guide_resolve( $path ) {
	global $wp;
	$_SERVER['REQUEST_URI'] = $path;
	$wp->parse_request();
	return $wp->query_vars;
}

function my_plugin_add_endpoint() {
	add_rewrite_endpoint( 'reviews', EP_PERMALINK );
}
add_action( 'init', 'my_plugin_add_endpoint' );
my_plugin_add_endpoint();
flush_rewrite_rules( false );

$post = wp_insert_post( array( 'post_title' => 'Dune', 'post_name' => 'dune', 'post_status' => 'publish' ) );
$plain   = guide_resolve( '/dune/' );
$reviews = guide_resolve( '/dune/reviews/' );
$page_2  = guide_resolve( '/dune/reviews/2/' );
return array(
	'the post'       => $plain,
	'its reviews'    => $reviews,
	'with a value'   => $page_2,
	'isset, empty'   => isset( $reviews['reviews'] ) && '' === $reviews['reviews'],
);
