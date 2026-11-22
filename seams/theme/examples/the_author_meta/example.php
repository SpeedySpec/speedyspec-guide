<?php
// Prints a field of the post's author; filtered by the_author_{$field}.
$id = wp_insert_post( array( 'post_title' => 'By admin', 'post_status' => 'publish', 'post_author' => 1 ) );
guide_go( "/?p=$id" );
the_post();
return guide_render( fn() => the_author_meta( 'user_login' ) );
