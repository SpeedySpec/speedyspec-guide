<?php
// A variable of the main query, or a default when it isn't set.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

guide_go( "/?p=$id" );
return array( get_query_var( 'p' ), get_query_var( 'nope', 'fallback' ) );
