<?php
// How many published posts the current post's author has.
$id = wp_insert_post( array( 'post_title' => 'By admin', 'post_status' => 'publish', 'post_author' => 1 ) );
guide_go( "/?p=$id" );
the_post();
wp_insert_post( array( 'post_title' => 'Another', 'post_status' => 'publish', 'post_author' => 1 ) );
return get_the_author_posts();
