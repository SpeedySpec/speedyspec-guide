<?php
// Created on first use after init, firing wp_abilities_api_categories_init once.
function guide_print_registry_class( $registry ) {
	echo get_class( $registry ) . "\n";
}
add_action( 'wp_abilities_api_categories_init', 'guide_print_registry_class' );
$r = WP_Ability_Categories_Registry::get_instance();
return array( $r === WP_Ability_Categories_Registry::get_instance(), $r->get_all_registered(), $r->is_registered( 'x' ) );
