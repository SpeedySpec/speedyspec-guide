<?php
// The URL of a page of the current post's comments; filtered by get_comments_pagenum_link.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
guide_go( "/?p=$id" );
the_post();
return get_comments_pagenum_link( 2 );
