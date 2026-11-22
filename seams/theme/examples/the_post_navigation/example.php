<?php
// Prints the navigation to the previous and next posts.
$a = wp_insert_post( array( 'post_title' => 'First', 'post_status' => 'publish', 'post_date' => '2026-01-01 00:00:00' ) );
$b = wp_insert_post( array( 'post_title' => 'Second', 'post_status' => 'publish', 'post_date' => '2026-01-02 00:00:00' ) );
$c = wp_insert_post( array( 'post_title' => 'Third', 'post_status' => 'publish', 'post_date' => '2026-01-03 00:00:00' ) );
guide_go( "/?p=$b" );
the_post();
return str_contains( guide_render( 'the_post_navigation' ), 'post-navigation' );
