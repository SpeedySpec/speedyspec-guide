<?php
// Whether the main query is for a single post of a type other than page or attachment, optionally given ones by ID, title or slug.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
guide_go( "/?p=$id" );
return array( is_single(), is_single( $id ), is_single( 'hello' ), is_single( 'nope' ) );
