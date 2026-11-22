<?php
// The object the main query is for: the post of a single view, the term of a term archive, the user of an author archive, the post type of a type archive; null on the home page.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

guide_go( "/?p=$id" );
$post = get_queried_object();
guide_go( '/?cat=1' );
return array( get_class( $post ), get_queried_object()->slug );
