<?php
// Every rule: extra rules on top, then the robots, favicon, sitemap and random rules, the root, comments, search, author, date, post, page and extra structures; each group has its own filter, and rewrite_rules_array the whole.
$r = guide_permalinks( '/%year%/%monthnum%/%postname%/' );
add_rewrite_rule( '^guide/?$', 'index.php?guide=1', 'top' );
add_filter( 'search_rewrite_rules', fn( $rules ) => array() );
add_filter( 'rewrite_rules_array', fn( $rules ) => array_slice( $rules, 0, 6 ) );
add_action( 'generate_rewrite_rules', fn( $r ) => print( "generate_rewrite_rules\n" ) );
return $r->rewrite_rules();
