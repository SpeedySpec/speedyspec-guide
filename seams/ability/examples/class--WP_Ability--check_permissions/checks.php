<?php
// Every required capability, then the permission callback; wp_ability_permission_result filters the result, and anything but a bool or an error is false.
function guide_register_tools_category() {
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) );
}
add_action( 'wp_abilities_api_categories_init', 'guide_register_tools_category' );
function guide_register_admin_ability() {
	wp_register_ability( 'guide/admin', array( 'label' => 'A', 'description' => 'D.', 'category' => 'tools', 'execute_callback' => '__return_true', 'required_capabilities' => array( 'manage_options' ), 'permission_callback' => fn() => 'yes' ) );
}
add_action( 'wp_abilities_api_init', 'guide_register_admin_ability' );
$ability = wp_get_ability( 'guide/admin' );
$without = $ability->check_permissions();
function guide_grant_manage_options( $allcaps ) {
	return $allcaps + array( 'manage_options' => true );
}
add_filter( 'user_has_cap', 'guide_grant_manage_options' );
$non_bool = $ability->check_permissions();
function guide_allow_permission( $result ) {
	return true;
}
add_filter( 'wp_ability_permission_result', 'guide_allow_permission' );
return array( $without, $non_bool, $ability->check_permissions(), $ability->execute() );
