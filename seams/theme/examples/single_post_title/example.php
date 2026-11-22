<?php
// The title of the single post or page queried, printed or given; filtered by single_post_title.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
guide_go( "/?p=$id" );
the_post();
return single_post_title( 'Reading: ', false );
