<?php
// A page's permalink, the home URL for the front page; filtered by page_link.
$page = wp_insert_post( array( 'post_title' => 'About', 'post_name' => 'about', 'post_type' => 'page', 'post_status' => 'publish' ) );
update_option( 'permalink_structure', '/%postname%/' );
$GLOBALS['wp_rewrite']->init();
$link = get_page_link( $page );
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $page );
return array( $link, get_page_link( $page ) );
