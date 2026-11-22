<?php
// Sets a post's format as its post_format term; standard or empty removes it.
add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
$id = wp_insert_post( array( 'post_title' => 'Short', 'post_status' => 'publish' ) );

set_post_format( $id, 'gallery' );
$set = wp_get_object_terms( $id, 'post_format', array( 'fields' => 'slugs' ) );
set_post_format( $id, 'standard' );
return array( $set, get_post_format( $id ) );
