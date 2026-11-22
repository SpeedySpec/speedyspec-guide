<?php
// Every registered category, by slug.
function guide_register_tools_category() {
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) );
}
add_action( 'wp_abilities_api_categories_init', 'guide_register_tools_category' );
return array_map( fn( $c ) => $c->get_label(), wp_get_ability_categories() );
