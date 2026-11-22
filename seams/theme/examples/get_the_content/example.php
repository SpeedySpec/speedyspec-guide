<?php
// The current post's content, cut at the more tag (with a more link) unless on a single view; the password form for protected posts.
$id = wp_insert_post( array( 'post_title' => 'Hello & World', 'post_status' => 'publish', 'post_content' => 'First part.<!--more-->Rest of it.', 'post_excerpt' => '' ) );
guide_go( "/?p=$id" );
the_post();
guide_go( '/' );
the_post();
return get_the_content( 'Continue' );
