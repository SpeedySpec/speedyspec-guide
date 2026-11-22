<?php
// After a split of a nav_menu term, moves the theme's menu locations to the new ID.
set_theme_mod( 'nav_menu_locations', array( 'primary' => 5 ) );
_wp_check_split_nav_menu_terms( 5, 9, 1, 'nav_menu' );
return get_theme_mod( 'nav_menu_locations' );
