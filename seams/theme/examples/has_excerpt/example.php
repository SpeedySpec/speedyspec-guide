<?php
// Whether a post has its own excerpt; filtered by has_excerpt.
$id = wp_insert_post( array( 'post_title' => 'Hello & World', 'post_status' => 'publish', 'post_content' => 'First part.<!--more-->Rest of it.', 'post_excerpt' => '' ) );
guide_go( "/?p=$id" );
the_post();
$own = wp_insert_post( array( 'post_title' => 'X', 'post_excerpt' => 'Short.' ) );
return array( has_excerpt(), has_excerpt( $own ) );
