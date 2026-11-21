<?php
// A name without a namespace, a category not registered, or missing properties are refused with a notice.
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
add_action( 'wp_abilities_api_init', function () {
	wp_register_ability( 'add', array() );
	wp_register_ability( 'guide/x', array( 'category' => 'nope' ) );
	wp_register_ability( 'guide/y', array( 'category' => 'tools', 'label' => 'Y' ) );
} );
return wp_get_abilities();
