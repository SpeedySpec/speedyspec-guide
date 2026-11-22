<?php
// Prints the current post's permalink for a feed; filtered by the_permalink_rss.
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish' ) );
guide_go( "/?p=$id&feed=rss2" );
the_post();
return guide_render( 'the_permalink_rss' ) === get_permalink( $id );
