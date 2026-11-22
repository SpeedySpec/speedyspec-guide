<?php
// A post's permalink from the permalink structure's tags (%year%, %postname%, %category% and the rest), plain ?p= links for drafts; filtered by post_link, pre_post_link and post_type_link.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
$plain = get_permalink( $id );
update_option( 'permalink_structure', '/%year%/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return array( $plain, get_permalink( $id ), get_permalink( wp_insert_post( array( 'post_title' => 'Draft' ) ) ) );
