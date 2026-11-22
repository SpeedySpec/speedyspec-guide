<?php
// The post meta for a location: at the top the author, date, comments and sticky, at the bottom the tags, each with an icon; both lists are filtered, pages get none, and nothing when no item applies.
guide_theme( 'twentytwenty' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
$top = twentytwenty_get_post_meta( $post, 'single-top' );
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) );
preg_match_all( '/<li class="([a-z-]+) meta-wrapper"/', $top, $m );
return array( $m[1], twentytwenty_get_post_meta( $page, 'single-top' ), twentytwenty_get_post_meta( $post, 'single-bottom' ) );
