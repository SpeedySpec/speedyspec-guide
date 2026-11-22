<?php
// The body's classes for the page queried: home, single, page, archive, logged-in, template and term classes and the rest; filtered by body_class.
$id = wp_insert_post( array( 'post_title' => 'Hello & World', 'post_status' => 'publish', 'post_content' => 'First part.<!--more-->Rest of it.', 'post_excerpt' => '' ) );
guide_go( "/?p=$id" );
the_post();
$single = get_body_class();
guide_go( '/?cat=1' );
return array( $single, get_body_class() );
