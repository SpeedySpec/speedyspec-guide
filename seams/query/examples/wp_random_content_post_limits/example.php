<?php
// Hooked to post_limits while a random request runs: removes the limit, so paging doesn't affect the pick.
$q = new WP_Query();
$q->parse_query( array( 'random' => '' ) );
$GLOBALS['wp_the_query'] = $q;

return array( wp_random_content_post_limits( 'LIMIT 0, 10', $q ), wp_random_content_post_limits( 'LIMIT 0, 10', new WP_Query() ) );
