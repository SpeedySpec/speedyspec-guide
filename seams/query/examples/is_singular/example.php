<?php
// Whether the main query is for a single post of any type, pages and attachments included, optionally of given post types.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
guide_go( "/?p=$id" );
return array( is_singular(), is_singular( 'post' ), is_singular( 'page' ) );
