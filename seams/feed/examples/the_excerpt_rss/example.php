<?php
// Prints the current post's excerpt for a feed; filtered by the_excerpt_rss.
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish', 'post_excerpt' => 'A <b>grassy</b> green tea.' ) );
guide_go( "/?p=$id&feed=rss2" );
the_post();
return guide_render( 'the_excerpt_rss' );
