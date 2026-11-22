<?php
// Whether the main query has the random query variable, a request for a random post such as /random/.
$q = new WP_Query();
$q->parse_query( array( 'random' => '' ) );
$GLOBALS['wp_query'] = $q;
$random = is_random();
$GLOBALS['wp_query'] = $GLOBALS['wp_the_query'];
guide_go( '/' );
return array( $random, is_random() );
