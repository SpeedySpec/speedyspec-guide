<?php
// The post types a random content request picks from: those the query would return (post by default, the searchable types of a taxonomy archive) that are registered randomable.
$q = new WP_Query();
$q->parse_query( array( 'random' => '' ) );
$GLOBALS['wp_the_query'] = $q;

register_post_type( 'book', array( 'public' => true, 'randomable' => false ) );
$books = new WP_Query();
$books->parse_query( array( 'random' => '', 'post_type' => array( 'post', 'book' ) ) );
return array( wp_get_random_content_post_types( $q ), wp_get_random_content_post_types( $books ) );
