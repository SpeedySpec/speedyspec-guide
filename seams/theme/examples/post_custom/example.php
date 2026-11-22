<?php
// A meta value of the current post, one value or all of them.
$id = wp_insert_post( array( 'post_title' => 'Hello & World', 'post_status' => 'publish', 'post_content' => 'First part.<!--more-->Rest of it.', 'post_excerpt' => '' ) );
guide_go( "/?p=$id" );
the_post();
add_post_meta( $id, 'mood', 'happy' );
return post_custom( 'mood' );
