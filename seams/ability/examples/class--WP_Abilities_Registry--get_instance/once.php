<?php
// The first call creates the registry, starts the categories registry, and fires wp_abilities_api_init once with it.
add_action( 'wp_abilities_api_categories_init', fn() => print( "categories\n" ) );
add_action( 'wp_abilities_api_init', fn( $registry ) => print( get_class( $registry ) . "\n" ) );
return WP_Abilities_Registry::get_instance() === WP_Abilities_Registry::get_instance();
