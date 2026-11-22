<?php
// Prints a post type's Add menu items box: Most Recent, View All and Search tabs of checkboxes.
wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About us', 'post_status' => 'publish' ) );
$html = guide_render( fn() => wp_nav_menu_item_post_type_meta_box( null, array( 'id' => 'add-post-type-page', 'title' => 'Pages', 'args' => get_post_type_object( 'page' ) ) ) );
return array( str_contains( $html, 'posttype-page' ), str_contains( $html, 'About us' ) );
