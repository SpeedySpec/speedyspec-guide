<?php
// Prints the current post's content for a feed of a type.
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish', 'post_content' => 'Steep it for two minutes.' ) );
guide_go( "/?p=$id&feed=rss2" );
the_post();
return guide_render( fn() => the_content_feed( 'rss2' ) );
