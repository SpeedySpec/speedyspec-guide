<?php
// Prints the current post's permalink, escaped; filtered by the_permalink.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
guide_go( "/?p=$id" );
the_post();
return guide_render( 'the_permalink' );
