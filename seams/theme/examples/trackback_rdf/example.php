<?php
// Prints the trackback RDF for the current post, except for W3C validator user agents.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
guide_go( "/?p=$id" );
the_post();
return str_contains( guide_render( 'trackback_rdf' ), 'trackback:ping' );
