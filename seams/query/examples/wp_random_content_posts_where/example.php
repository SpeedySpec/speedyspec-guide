<?php
// Hooked to posts_where while a random request runs: adds the sample IDs condition.
$q = new WP_Query();
$q->parse_query( array( 'random' => '' ) );
$GLOBALS['wp_the_query'] = $q;

$q->set( 'random_sample_ids', array( 2, 5 ) );
return array( wp_random_content_posts_where( ' AND 1=1', $q ), wp_random_content_posts_where( ' AND 1=1', new WP_Query() ) );
