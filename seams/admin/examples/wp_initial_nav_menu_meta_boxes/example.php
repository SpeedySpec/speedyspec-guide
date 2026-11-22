<?php
// Hides all but the Pages, Posts, Custom Links and Categories boxes for a user who never chose, on the menus screen.
set_current_screen( 'nav-menus' );
wp_nav_menu_setup();
wp_initial_nav_menu_meta_boxes();
return get_user_option( 'metaboxhidden_nav-menus' );
