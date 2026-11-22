<?php
// A post's title escaped for the admin, or (no title).
$titled = wp_insert_post( array( 'post_title' => 'Tea & cake', 'post_status' => 'publish' ) );
$untitled = wp_insert_post( array( 'post_title' => '', 'post_content' => 'x', 'post_status' => 'draft' ) );
return array( _draft_or_post_title( $titled ), _draft_or_post_title( $untitled ) );
