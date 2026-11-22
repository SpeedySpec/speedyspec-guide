<?php
// Whether the main query is for a preview.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
guide_go( "/?p=$id&preview=true" );
return is_preview();
