<?php
// The permalink of a post of a custom type, from its permastructure; filtered by post_type_link.
register_post_type( 'book', array( 'public' => true, 'rewrite' => array( 'slug' => 'books' ) ) );
$id = wp_insert_post( array( 'post_title' => 'Dune', 'post_type' => 'book', 'post_status' => 'publish' ) );
$plain = get_post_permalink( $id );
update_option( 'permalink_structure', '/%postname%/' );
$GLOBALS['wp_rewrite']->init();
register_post_type( 'book', array( 'public' => true, 'rewrite' => array( 'slug' => 'books' ) ) );
return array( $plain, get_post_permalink( $id ) );
