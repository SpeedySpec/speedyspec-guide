<?php
// Registers the menu locations: Desktop Horizontal, Desktop Expanded, Mobile, Footer and Social; on init.
guide_theme( 'twentytwenty' );
twentytwenty_menus();
return get_registered_nav_menus();
