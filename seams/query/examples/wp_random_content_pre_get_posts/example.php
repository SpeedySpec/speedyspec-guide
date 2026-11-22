<?php
// Hooked to pre_get_posts while a random request runs: limits the query to randomable types, published posts without a password, and a sample of random IDs.
$q = new WP_Query();
$q->parse_query( array( 'random' => '' ) );
$GLOBALS['wp_the_query'] = $q;

wp_random_content_pre_get_posts( $q );
return array( $q->get( 'post_type' ), $q->get( 'post_status' ), $q->get( 'has_password' ), is_array( $q->get( 'random_sample_ids' ) ) );
