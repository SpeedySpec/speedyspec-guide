<?php
// Prints the name of the user who last edited the current post.
$id = wp_insert_post( array( 'post_title' => 'By admin', 'post_status' => 'publish', 'post_author' => 1 ) );
guide_go( "/?p=$id" );
the_post();
update_post_meta( $id, '_edit_last', 1 );
return guide_render( 'the_modified_author' );
