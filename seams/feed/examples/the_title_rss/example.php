<?php
// Prints the current post's title for a feed.
$id = wp_insert_post( array( 'post_title' => 'Sencha & Matcha', 'post_status' => 'publish' ) );
guide_go( "/?p=$id&feed=rss2" );
the_post();
return guide_render( 'the_title_rss' );
