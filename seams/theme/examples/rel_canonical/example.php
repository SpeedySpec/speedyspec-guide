<?php
// Hooked to wp_head: prints the canonical link tag on singular views.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
guide_go( "/?p=$id" );
return guide_render( 'rel_canonical' );
