<?php
// A post's title, with Protected: or Private: added for those posts; filtered by the_title.
$id = wp_insert_post( array( 'post_title' => 'Hello & World', 'post_status' => 'publish', 'post_content' => 'First part.<!--more-->Rest of it.', 'post_excerpt' => '' ) );
guide_go( "/?p=$id" );
the_post();
$private = wp_insert_post( array( 'post_title' => 'Secret', 'post_status' => 'private' ) );
return array( get_the_title(), get_the_title( $private ) );
