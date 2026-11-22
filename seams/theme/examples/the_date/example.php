<?php
// Prints the current post's date, once per day across the Loop, with markup before and after; filtered by the_date.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
guide_go( "/?p=$id" );
the_post();
return array( the_date( 'Y-m-d', '<h2>', '</h2>', false ), the_date( 'Y-m-d', '', '', false ) );
