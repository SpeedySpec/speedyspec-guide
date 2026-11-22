<?php
// Ajax handler for the menus screen's search: prints the posts and terms matching the typed text as menu item checkboxes.
wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About us', 'post_status' => 'publish' ) );
$sent = guide_ajax( 'wp_ajax_menu_quick_search', array( 'type' => 'quick-search-posttype-page', 'q' => 'About', 'response-format' => 'markup' ) );
return str_contains( $sent, 'About us' );
