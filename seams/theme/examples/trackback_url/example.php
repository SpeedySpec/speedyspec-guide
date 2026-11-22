<?php
// Prints the current post's trackback URL.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
guide_go( "/?p=$id" );
the_post();
return guide_render( 'trackback_url' );
