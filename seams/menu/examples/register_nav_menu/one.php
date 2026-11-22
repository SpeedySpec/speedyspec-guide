<?php
// Registers one location; registering a slug again replaces its description.
register_nav_menu( 'primary', 'Primary' );
register_nav_menu( 'primary', 'Main navigation' );
return get_registered_nav_menus();
