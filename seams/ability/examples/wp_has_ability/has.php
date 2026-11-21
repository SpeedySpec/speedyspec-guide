<?php
// Whether an ability is registered, without a notice when it isn't.
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
add_action( 'wp_abilities_api_init', fn() => wp_register_ability( 'guide/add', array(
	'label' => 'Add one', 'description' => 'Adds one to a number.', 'category' => 'tools',
	'input_schema' => array( 'type' => 'object', 'properties' => array( 'n' => array( 'type' => 'integer', 'minimum' => 0 ) ), 'required' => array( 'n' ) ),
	'output_schema' => array( 'type' => 'integer' ),
	'execute_callback' => fn( $input ) => $input['n'] + 1,
	'permission_callback' => '__return_true',
	'meta' => array( 'annotations' => array( 'readonly' => true ), 'public' => true ),
) ) );
return array( wp_has_ability( 'guide/add' ), wp_has_ability( 'guide/none' ) );
