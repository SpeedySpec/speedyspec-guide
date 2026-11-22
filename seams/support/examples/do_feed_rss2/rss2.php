<?php
// Loads the RSS 2.0 feed template, the comments feed when asked.
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
wp( array( 'feed' => 'rss2' ) );
$xml = guide_render( fn() => do_feed_rss2( false ) );
return array( str_contains( $xml, '<rss version="2.0"' ), str_contains( $xml, '<title>Hello</title>' ) );
