<?php
// An attachment page's permalink, under its parent's permalink when it has one; filtered by attachment_link.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_name' => 'pic', 'post_mime_type' => 'image/jpeg', 'post_parent' => $id ) );
$plain = get_attachment_link( $att );
update_option( 'permalink_structure', '/%year%/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return array( $plain, get_attachment_link( $att ) );
