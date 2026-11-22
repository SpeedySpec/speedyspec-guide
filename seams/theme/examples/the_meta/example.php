<?php
// Prints the current post's public meta as a list; deprecated in 6.0.2.
$id = wp_insert_post( array( 'post_title' => 'Hello & World', 'post_status' => 'publish', 'post_content' => 'First part.<!--more-->Rest of it.', 'post_excerpt' => '' ) );
guide_go( "/?p=$id" );
the_post();
add_post_meta( $id, 'mood', 'happy' );
return guide_render( 'the_meta' );
