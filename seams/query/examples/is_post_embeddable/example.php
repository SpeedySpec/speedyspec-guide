<?php
// Whether a post can be embedded elsewhere: its type is viewable and embeddable; filtered by is_post_embeddable.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
register_post_type( 'book', array( 'public' => true, 'embeddable' => false ) );
$book = wp_insert_post( array( 'post_title' => 'B', 'post_type' => 'book', 'post_status' => 'publish' ) );
return array( is_post_embeddable( $id ), is_post_embeddable( $book ) );
