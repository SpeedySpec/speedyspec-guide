<?php
// Adds body classes: singular, the cover and full width templates, enable-search-modal, has- or missing-post-thumbnail, pagination, comments, avatars, footer-top-visible or -hidden, and reduced-spacing when the header and background colors match; on body_class.
guide_theme( 'twentytwenty' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
return twentytwenty_body_classes( array() );
