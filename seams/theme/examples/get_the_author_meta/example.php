<?php
// A field of the current post's author or a given user (email, display_name, description, a user meta key); filtered by get_the_author_{$field}.
$id = wp_insert_post( array( 'post_title' => 'By admin', 'post_status' => 'publish', 'post_author' => 1 ) );
guide_go( "/?p=$id" );
the_post();
update_user_meta( 1, 'description', 'Writes things.' );
return array( get_the_author_meta( 'user_email' ), get_the_author_meta( 'description' ), get_the_author_meta( 'display_name', 1 ) );
