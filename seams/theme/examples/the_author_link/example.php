<?php
// Prints the post author's linked name.
$id = wp_insert_post( array( 'post_title' => 'By admin', 'post_status' => 'publish', 'post_author' => 1 ) );
guide_go( "/?p=$id" );
the_post();
return guide_render( 'the_author_link' );
