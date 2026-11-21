<?php
// With no post type exposed to abilities, core/content-query isn't registered.
$GLOBALS['wp_roles'] = ( new ReflectionClass( 'WP_Roles' ) )->newInstanceWithoutConstructor();
$GLOBALS['wp_roles']->roles = array();
add_action( 'wp_abilities_api_categories_init', 'wp_register_core_ability_categories' );
add_action( 'wp_abilities_api_init', 'wp_register_core_abilities' );
return wp_has_ability( 'core/content-query' );
