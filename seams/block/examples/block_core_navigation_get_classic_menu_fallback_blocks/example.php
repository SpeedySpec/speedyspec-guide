<?php
// A classic menu converted to Navigation block markup.
$menu = wp_create_nav_menu( 'Main' );
wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Docs', 'menu-item-url' => 'https://example.org/docs', 'menu-item-status' => 'publish' ) );
return block_core_navigation_get_classic_menu_fallback_blocks( wp_get_nav_menu_object( $menu ) );
