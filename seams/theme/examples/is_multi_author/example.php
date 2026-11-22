<?php
// Whether more than one user has published posts, cached; filtered by is_multi_author.
$grace = wp_insert_user( array( 'user_login' => 'grace', 'user_pass' => 'x', 'user_email' => 'g@example.org', 'role' => 'author' ) );
wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_author' => 1 ) );
$one = is_multi_author();
wp_insert_post( array( 'post_title' => 'G', 'post_status' => 'publish', 'post_author' => $grace ) );
__clear_multi_author_cache();
return array( $one, is_multi_author() );
