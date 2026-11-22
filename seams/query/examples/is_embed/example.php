<?php
// Whether the main query is for an embed of a post.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
guide_go( "/?p=$id&embed=true" );
return array( is_embed(), is_single() );
