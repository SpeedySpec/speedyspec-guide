<?php
// Created on first use after init, firing wp_abilities_api_categories_init once.
add_action( 'wp_abilities_api_categories_init', fn( $r ) => print( get_class( $r ) . "\n" ) );
$r = WP_Ability_Categories_Registry::get_instance();
return array( $r === WP_Ability_Categories_Registry::get_instance(), $r->get_all_registered(), $r->is_registered( 'x' ) );
