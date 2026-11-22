<?php
// Every ability, or those matching a category, a namespace, meta values or the current user's capabilities.
function guide_register_categories() {
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) );
	wp_register_ability_category( 'site', array( 'label' => 'Site', 'description' => 'Site things.' ) );
}
add_action( 'wp_abilities_api_categories_init', 'guide_register_categories' );
function guide_register_abilities() {
	$base = array( 'description' => 'D.', 'execute_callback' => '__return_true' );
	wp_register_ability( 'guide/a', $base + array( 'label' => 'A', 'category' => 'tools', 'permission_callback' => '__return_true', 'meta' => array( 'public' => true ) ) );
	wp_register_ability( 'guide/b', $base + array( 'label' => 'B', 'category' => 'site', 'required_capabilities' => array( 'manage_options' ) ) );
	wp_register_ability( 'other/c', $base + array( 'label' => 'C', 'category' => 'tools', 'permission_callback' => '__return_true' ) );
}
add_action( 'wp_abilities_api_init', 'guide_register_abilities' );
function guide_grant_manage_options( $allcaps ) {
	return $allcaps + array( 'manage_options' => true );
}
add_filter( 'user_has_cap', 'guide_grant_manage_options' );
return array(
	array_keys( wp_get_abilities() ),
	array_keys( wp_get_abilities( array( 'category' => 'tools' ) ) ),
	array_keys( wp_get_abilities( array( 'namespace' => 'guide' ) ) ),
	array_keys( wp_get_abilities( array( 'meta' => array( 'public' => true ) ) ) ),
	array_keys( wp_get_abilities( array( 'has_required_capabilities' => true ) ) ),
);
