<?php
// Prepares the input (default, validation, sanitizing), checks permission, runs the callback and checks the output, firing wp_ability_invoked, wp_before_execute_ability and wp_after_execute_ability.
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
add_action( 'wp_abilities_api_init', fn() => wp_register_ability( 'guide/add', array(
	'label' => 'Add one', 'description' => 'Adds one to a number.', 'category' => 'tools',
	'input_schema' => array( 'type' => 'object', 'properties' => array( 'n' => array( 'type' => 'integer', 'minimum' => 0 ) ), 'required' => array( 'n' ) ),
	'output_schema' => array( 'type' => 'integer' ),
	'execute_callback' => fn( $input ) => $input['n'] + 1,
	'permission_callback' => '__return_true',
	'meta' => array( 'annotations' => array( 'readonly' => true ), 'public' => true ),
) ) );
foreach ( array( 'wp_ability_invoked', 'wp_before_execute_ability', 'wp_after_execute_ability' ) as $hook ) {
	add_action( $hook, fn( $name ) => print( "$hook $name\n" ) );
}
$ability = wp_get_ability( 'guide/add' );
return array( $ability->execute( array( 'n' => '4' ) ), $ability->execute( array( 'n' => -1 ) )->get_error_code(), $ability->execute()->get_error_code() );
