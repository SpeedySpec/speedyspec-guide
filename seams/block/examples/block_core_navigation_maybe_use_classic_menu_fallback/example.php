<?php
// Makes a navigation post from a classic menu when there is one, for the Navigation block's fallback.
$menu = wp_create_nav_menu( 'Main' );
wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Docs', 'menu-item-url' => 'https://example.org/docs', 'menu-item-status' => 'publish' ) );
$navigation = block_core_navigation_maybe_use_classic_menu_fallback();
return array( $navigation->post_type, $navigation->post_title );
