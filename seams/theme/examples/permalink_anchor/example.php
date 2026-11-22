<?php
// Prints an anchor named after the current post, by ID or title.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
guide_go( "/?p=$id" );
the_post();
return array( guide_render( 'permalink_anchor' ), guide_render( fn() => permalink_anchor( 'title' ) ) );
