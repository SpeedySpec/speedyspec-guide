<?php
// Loads the RDF/RSS 1.0 feed template, feed-rdf.php.
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
wp( array( 'feed' => 'rdf' ) );
$xml = guide_render( 'do_feed_rdf' );
return substr( $xml, 0, 38 );
