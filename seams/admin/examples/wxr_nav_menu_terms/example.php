<?php
// Prints the navigation menus as wp:term elements for the export; defined by export_wp().
guide_render( 'export_wp' );
wp_create_nav_menu( 'Main' );
return str_contains( guide_render( 'wxr_nav_menu_terms' ), 'nav_menu' );
