<?php
// A post's excerpt: its own, else made from its content (55 words); the password note for protected posts; filtered by get_the_excerpt.
$id = wp_insert_post( array( 'post_title' => 'Hello & World', 'post_status' => 'publish', 'post_content' => 'First part.<!--more-->Rest of it.', 'post_excerpt' => '' ) );
guide_go( "/?p=$id" );
the_post();
$own = wp_insert_post( array( 'post_title' => 'X', 'post_status' => 'publish', 'post_excerpt' => 'Short summary.' ) );
return array( get_the_excerpt(), get_the_excerpt( $own ) );
