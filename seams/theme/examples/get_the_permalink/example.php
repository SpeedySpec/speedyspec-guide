<?php
// A post's permalink; an alias of get_permalink().
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
update_option( 'permalink_structure', '/%year%/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return get_the_permalink( $id );
