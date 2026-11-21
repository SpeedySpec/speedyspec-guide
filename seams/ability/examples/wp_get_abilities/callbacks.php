<?php
// item_include_callback and wp_get_abilities_item_include decide each ability; result_callback and wp_get_abilities_result change the result.
add_action( 'wp_abilities_api_categories_init', function () {
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) );
	wp_register_ability_category( 'site', array( 'label' => 'Site', 'description' => 'Site things.' ) );
} );
add_action( 'wp_abilities_api_init', function () {
	$base = array( 'description' => 'D.', 'execute_callback' => '__return_true' );
	wp_register_ability( 'guide/a', $base + array( 'label' => 'A', 'category' => 'tools', 'permission_callback' => '__return_true', 'meta' => array( 'public' => true ) ) );
	wp_register_ability( 'guide/b', $base + array( 'label' => 'B', 'category' => 'site', 'required_capabilities' => array( 'manage_options' ) ) );
	wp_register_ability( 'other/c', $base + array( 'label' => 'C', 'category' => 'tools', 'permission_callback' => '__return_true' ) );
} );
add_filter( 'wp_get_abilities_item_include', fn( $include, $ability ) => $include && 'other/c' !== $ability->get_name(), 10, 2 );
add_filter( 'wp_get_abilities_result', fn( $matched ) => array_keys( $matched ) );
return wp_get_abilities( array( 'item_include_callback' => fn( $a ) => 'B' !== $a->get_label(), 'result_callback' => fn( $m ) => array_reverse( $m ) ) );
