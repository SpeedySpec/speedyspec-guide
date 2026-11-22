<?php
// Whether the current query is the main query; inside pre_get_posts use the query's own is_main_query().
guide_go( '/' );
$main = is_main_query();
$GLOBALS['wp_query'] = new WP_Query();
$other = is_main_query();
$GLOBALS['wp_query'] = $GLOBALS['wp_the_query'];
return array( $main, $other );
