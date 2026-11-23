<?php
// Map a URL of your own to query variables with add_rewrite_rule(), and register the variable on query_vars.
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

function my_plugin_add_rewrite_rules() {
	add_rewrite_rule( '^books/([^/]+)/?$', 'index.php?my_plugin_book=$matches[1]', 'top' );
}
add_action( 'init', 'my_plugin_add_rewrite_rules' );

function my_plugin_query_vars( $vars ) {
	$vars[] = 'my_plugin_book';
	return $vars;
}
add_filter( 'query_vars', 'my_plugin_query_vars' );

my_plugin_add_rewrite_rules(); // The example runs after init, so it adds the rule itself.
flush_rewrite_rules( false ); // Only so the example sees the rule; a plugin flushes on activation.

return array(
	'a book'      => guide_resolve( '/books/dune/' ),
	'a post'      => guide_resolve( '/hello-world/' ),
);
