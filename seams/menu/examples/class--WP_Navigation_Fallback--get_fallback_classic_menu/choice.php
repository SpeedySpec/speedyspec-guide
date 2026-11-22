<?php
// The classic menu to convert: the one at the primary location, else one with the slug primary, else the newest; none without menus.
$none = guide_call( 'WP_Navigation_Fallback', 'get_fallback_classic_menu' );
$first = wp_create_nav_menu( 'First' );
$newest = guide_call( 'WP_Navigation_Fallback', 'get_fallback_classic_menu' )->name;
wp_create_nav_menu( 'Primary' );
wp_create_nav_menu( 'Last' );
$by_slug = guide_call( 'WP_Navigation_Fallback', 'get_fallback_classic_menu' )->name;
set_theme_mod( 'nav_menu_locations', array( 'primary' => $first ) );
return array( $none, $newest, $by_slug, guide_call( 'WP_Navigation_Fallback', 'get_fallback_classic_menu' )->name );
