<?php
// Hooked to posts_fields while a random request runs: selects only post IDs.
$q = new WP_Query();
$q->parse_query( array( 'random' => '' ) );
$GLOBALS['wp_the_query'] = $q;

return array( wp_random_content_posts_fields( 'guide_posts.*', $q ), wp_random_content_posts_fields( 'guide_posts.*', new WP_Query() ) );
