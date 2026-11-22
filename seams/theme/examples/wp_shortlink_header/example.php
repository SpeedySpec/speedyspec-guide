<?php
// Hooked to wp: sends the shortlink in a Link header; nothing once headers are sent.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
guide_go( "/?p=$id" );
return wp_shortlink_header();
