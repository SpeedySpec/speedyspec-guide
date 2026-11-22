<?php
// No input becomes the schema's default; wp_ability_normalize_input filters it. prepare_input() then validates it: here the filter's numbers fail the string schema.
function guide_register_tools_category() {
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) );
}
add_action( 'wp_abilities_api_categories_init', 'guide_register_tools_category' );
function guide_register_default_ability() {
	wp_register_ability( 'guide/def', array( 'label' => 'D', 'description' => 'D.', 'category' => 'tools', 'input_schema' => array( 'type' => 'object', 'properties' => array( 'tags' => array( 'type' => 'array', 'items' => array( 'type' => 'string' ) ) ), 'default' => array( 'tags' => array() ) ), 'execute_callback' => fn( $in ) => $in, 'permission_callback' => '__return_true' ) );
}
add_action( 'wp_abilities_api_init', 'guide_register_default_ability' );
$ability = wp_get_ability( 'guide/def' );
$normalized = $ability->normalize_input();
function guide_numeric_tags( $input ) {
	return array( 'tags' => array( 1, 2 ) );
}
add_filter( 'wp_ability_normalize_input', 'guide_numeric_tags' );
return array( $normalized, $ability->prepare_input( null )->get_error_message(), $ability->execute()->get_error_code() );
