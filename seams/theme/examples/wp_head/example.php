<?php
// Fires wp_head, where WordPress and plugins print the head's tags: title, styles, scripts, feeds, canonical and the rest.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
guide_go( "/?p=$id" );
the_post();
$html = guide_render( 'wp_head' );
return array( str_contains( $html, 'rel="canonical"' ), str_contains( $html, 'name="generator"' ), did_action( 'wp_head' ) );
