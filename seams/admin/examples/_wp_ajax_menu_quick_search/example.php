<?php
// Prints the menus screen's search results: posts and terms matching the text, as markup or JSON.
wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About us', 'post_status' => 'publish' ) );
$html = guide_render( fn() => _wp_ajax_menu_quick_search( array( 'type' => 'quick-search-posttype-page', 'q' => 'About', 'response-format' => 'markup' ) ) );
return str_contains( $html, 'About us' );
