<?php
// Hooked to posts_orderby while a random request runs: removes the order, so archives' ordering doesn't affect the pick.
$q = new WP_Query();
$q->parse_query( array( 'random' => '' ) );
$GLOBALS['wp_the_query'] = $q;

return array( wp_random_content_posts_orderby( 'post_date DESC', $q ), wp_random_content_posts_orderby( 'post_date DESC', new WP_Query() ) );
