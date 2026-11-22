<?php
// Prints the current post's content through the_content's formatting (blocks, autop, shortcodes, embeds), up to the more tag on listings.
$id = wp_insert_post( array( 'post_title' => 'Hello & World', 'post_status' => 'publish', 'post_content' => 'First part.<!--more-->Rest of it.', 'post_excerpt' => '' ) );
guide_go( "/?p=$id" );
the_post();
return guide_render( 'the_content' );
