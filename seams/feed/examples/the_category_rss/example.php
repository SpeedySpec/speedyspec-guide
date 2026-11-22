<?php
// Prints the current post's categories and tags for a feed.
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish', 'tags_input' => array( 'grassy' ) ) );
guide_go( "/?p=$id&feed=rss2" );
the_post();
return guide_render( fn() => the_category_rss( 'rss2' ) );
