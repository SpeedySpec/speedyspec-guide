<?php
// Whether a query is a random content request: the main front-end query of a GET or HEAD request for the home or an archive with the random variable, and a randomable post type to pick from; never singular, search, feed or sitemap requests.
$q = new WP_Query();
$q->parse_query( array( 'random' => '' ) );
$GLOBALS['wp_the_query'] = $q;

$other = new WP_Query();
$other->parse_query( array( 'random' => '' ) );
return array( wp_is_random_content_query( $q ), wp_is_random_content_query( $other ) );
