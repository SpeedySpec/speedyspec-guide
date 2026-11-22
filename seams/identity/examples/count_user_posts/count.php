<?php
// The number of a user's published posts of a type (or types), public ones only unless asked; get_usernumposts filters it.
$grace = guide_user();
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_author' => $grace ) );
wp_insert_post( array( 'post_title' => 'B', 'post_status' => 'draft', 'post_author' => $grace ) );
return array( count_user_posts( $grace ), count_user_posts( $grace, 'page' ), count_user_posts( 1 ) );
