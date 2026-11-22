<?php
// Prints a link to the current post's shortlink; filtered by the_shortlink.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
guide_go( "/?p=$id" );
the_post();
return guide_render( fn() => the_shortlink( 'Short' ) );
