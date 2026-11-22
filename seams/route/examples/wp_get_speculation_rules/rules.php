<?php
// The main document rule: links on the site, except WordPress's own paths, query strings, nofollow links and .no-prefetch; wp_speculation_rules_href_exclude_paths adds paths, and wp_load_speculation_rules can add rules.
guide_permalinks( '/%postname%/' );
add_filter( 'wp_speculation_rules_href_exclude_paths', fn( $paths, $mode ) => array( '/cart/*', 5 ), 10, 2 );
add_action( 'wp_load_speculation_rules', fn( $rules ) => $rules->add_rule( 'prerender', 'guide', array( 'source' => 'list', 'urls' => array( '/next/' ) ) ) );
return wp_json_encode( wp_get_speculation_rules(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
