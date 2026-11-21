<?php
// Validates input against the input schema; with no schema only no input is valid. wp_ability_validate_input can change the verdict.
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
add_action( 'wp_abilities_api_init', fn() => wp_register_ability( 'guide/add', array(
	'label' => 'Add one', 'description' => 'Adds one to a number.', 'category' => 'tools',
	'input_schema' => array( 'type' => 'object', 'properties' => array( 'n' => array( 'type' => 'integer', 'minimum' => 0 ) ), 'required' => array( 'n' ) ),
	'output_schema' => array( 'type' => 'integer' ),
	'execute_callback' => fn( $input ) => $input['n'] + 1,
	'permission_callback' => '__return_true',
	'meta' => array( 'annotations' => array( 'readonly' => true ), 'public' => true ),
) ) );
add_action( 'wp_abilities_api_init', fn() => wp_register_ability( 'guide/none', array( 'label' => 'N', 'description' => 'D.', 'category' => 'tools', 'execute_callback' => '__return_true', 'permission_callback' => '__return_true' ) ), 11 );
$add = wp_get_ability( 'guide/add' );
$none = wp_get_ability( 'guide/none' );
$results = array( $add->validate_input( array( 'n' => 1 ) ), $add->validate_input( array( 'n' => 'x' ) )->get_error_message(), $none->validate_input(), $none->validate_input( 1 )->get_error_code() );
add_filter( 'wp_ability_validate_input', fn() => false );
$results[] = $add->validate_input( array( 'n' => 1 ) )->get_error_code();
return $results;
