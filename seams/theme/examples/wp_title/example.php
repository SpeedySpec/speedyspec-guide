<?php
// The older page title with a separator and side, printed or given; filtered by wp_title_parts and wp_title. Themes should use title-tag instead.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
guide_go( "/?p=$id" );
the_post();
return wp_title( '|', false, 'right' );
