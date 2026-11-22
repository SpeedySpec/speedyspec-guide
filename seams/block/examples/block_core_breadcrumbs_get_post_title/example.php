<?php
// A post's title for a breadcrumb, with a fallback when it is empty.
$titled = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
$untitled = wp_insert_post( array( 'post_title' => '', 'post_content' => 'x', 'post_status' => 'publish' ) );
return array( block_core_breadcrumbs_get_post_title( $titled ), block_core_breadcrumbs_get_post_title( $untitled ) );
