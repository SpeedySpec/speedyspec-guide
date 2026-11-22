<?php
// The menu assigned to each location, from the theme mod nav_menu_locations; an empty array when it isn't an array.
$before = get_nav_menu_locations();
set_theme_mod( 'nav_menu_locations', array( 'primary' => 3 ) );
return array( $before, get_nav_menu_locations(), get_option( 'theme_mods_guide' ) );
