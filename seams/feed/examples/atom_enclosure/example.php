<?php
// Prints an Atom link rel="enclosure" for each media URL in the current post's enclosure meta; filtered by atom_enclosure.
$id = wp_insert_post( array( 'post_title' => 'Episode 1', 'post_status' => 'publish' ) );
add_post_meta( $id, 'enclosure', "https://example.org/episode-1.mp3\n12345\naudio/mpeg" );
guide_go( "/?p=$id&feed=atom" );
the_post();
return guide_render( 'atom_enclosure' );
