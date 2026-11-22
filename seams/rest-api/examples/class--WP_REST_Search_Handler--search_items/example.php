<?php
// A search handler of the search endpoint: its type (post, term, post-format), subtypes, and how it finds and prepares results; GET /wp/v2/search picks the handler by the type parameter.
wp_insert_post( array( 'post_title' => 'Find me', 'post_status' => 'publish' ) );
wp_insert_term( 'Findable', 'category' );
$posts = guide_rest( 'GET', '/wp/v2/search', array( 'search' => 'find' ) )[1];
$terms = guide_rest( 'GET', '/wp/v2/search', array( 'search' => 'find', 'type' => 'term' ) )[1];
$handler = new WP_REST_Post_Search_Handler();
return array( array_map( fn( $r ) => array( $r['title'], $r['type'], $r['subtype'] ), $posts ), array_map( fn( $r ) => array( $r['title'], $r['type'] ), $terms ), $handler->get_type(), $handler->get_subtypes() );
