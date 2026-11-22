<?php
// A post's short URL (?p=ID, the home URL for the front page); filtered by pre_get_shortlink and get_shortlink.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
update_option( 'permalink_structure', '/%year%/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return array( wp_get_shortlink( $id ), get_permalink( $id ) );
