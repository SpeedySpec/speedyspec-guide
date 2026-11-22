<?php
// A post's classes: post-{ID}, its type, status, format, sticky, has-post-thumbnail, its terms and extras; filtered by post_class.
$id = wp_insert_post( array( 'post_title' => 'Hello & World', 'post_status' => 'publish', 'post_content' => 'First part.<!--more-->Rest of it.', 'post_excerpt' => '' ) );
guide_go( "/?p=$id" );
the_post();
return get_post_class( 'card' );
