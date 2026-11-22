<?php
// With one old and one new location, the menu moves across whatever their names.
register_nav_menu( 'top', 'Top' );
return wp_map_nav_menu_locations( array(), array( 'anything' => 3 ) );
