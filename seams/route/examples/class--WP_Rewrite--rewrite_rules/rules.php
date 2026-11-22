<?php
// Every rule: extra rules on top, then the robots, favicon, sitemap and random rules, the root, comments, search, author, date, post, page and extra structures; each group has its own filter, and rewrite_rules_array the whole.
$r = guide_permalinks( '/%year%/%monthnum%/%postname%/' );
add_rewrite_rule( '^guide/?$', 'index.php?guide=1', 'top' );
function guide_no_search_rules( $rules ) {
	return array();
}
add_filter( 'search_rewrite_rules', 'guide_no_search_rules' );
function guide_first_rules( $rules ) {
	return array_slice( $rules, 0, 6 );
}
add_filter( 'rewrite_rules_array', 'guide_first_rules' );
function guide_print_generate( $wp_rewrite ) {
	print( "generate_rewrite_rules\n" );
}
add_action( 'generate_rewrite_rules', 'guide_print_generate' );
return $r->rewrite_rules();
