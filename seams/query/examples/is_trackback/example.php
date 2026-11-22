<?php
// Whether the main query is for a trackback.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
guide_go( "/?p=$id&tb=1" );
return is_trackback();
