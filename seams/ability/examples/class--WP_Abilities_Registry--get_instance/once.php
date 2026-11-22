<?php
// The first call creates the registry, starts the categories registry, and fires wp_abilities_api_init once with it.
function guide_print_categories_init() {
	echo "categories\n";
}
add_action( 'wp_abilities_api_categories_init', 'guide_print_categories_init' );
function guide_print_registry_class( $registry ) {
	echo get_class( $registry ) . "\n";
}
add_action( 'wp_abilities_api_init', 'guide_print_registry_class' );
return WP_Abilities_Registry::get_instance() === WP_Abilities_Registry::get_instance();
