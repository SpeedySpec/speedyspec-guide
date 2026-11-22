<?php
// Prints the post meta for a location (single-top or single-bottom).
guide_theme( 'twentytwenty' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
wp_set_post_tags( $post, array( 'news' ) );
$html = guide_render( fn() => twentytwenty_the_post_meta( $post, 'single-bottom' ) );
return array( str_contains( $html, 'post-meta-single-bottom' ), str_contains( $html, '>news</a>' ) );
