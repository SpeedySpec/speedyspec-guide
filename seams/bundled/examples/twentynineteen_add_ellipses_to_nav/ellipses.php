<?php
// Adds the More menu (an ellipsis toggle with a Back button) after the primary menu, where items that don't fit go; on wp_nav_menu.
guide_theme( 'twentynineteen' );
$html = twentynineteen_add_ellipses_to_nav( '<ul></ul>', (object) array( 'theme_location' => 'menu-1' ) );
return array( str_contains( $html, 'main-menu-more' ), twentynineteen_add_ellipses_to_nav( '<ul></ul>', (object) array( 'theme_location' => 'footer' ) ) );
