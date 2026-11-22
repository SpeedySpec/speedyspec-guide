<?php
// The abilities controllers under wp-abilities/v1: abilities shown in REST listed and described at /abilities, their categories at /categories, and an ability run at /abilities/<name>/run.
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
add_action( 'wp_abilities_api_init', fn() => wp_register_ability( 'guide/add', array(
	'label' => 'Add one', 'description' => 'Adds one to a number.', 'category' => 'tools',
	'input_schema' => array( 'type' => 'object', 'properties' => array( 'n' => array( 'type' => 'integer' ) ), 'required' => array( 'n' ) ),
	'output_schema' => array( 'type' => 'integer' ),
	'execute_callback' => fn( $input ) => $input['n'] + 1,
	'permission_callback' => '__return_true',
	'meta' => array( 'annotations' => array( 'readonly' => true ), 'show_in_rest' => true ),
) ) );
$abilities = guide_rest( 'GET', '/wp-abilities/v1/abilities' )[1];
$one = guide_rest( 'GET', '/wp-abilities/v1/abilities/guide/add' )[1];
$categories = guide_rest( 'GET', '/wp-abilities/v1/categories' )[1];
return array( in_array( 'guide/add', array_column( $abilities, 'name' ), true ), $one['category'], $one['input_schema']['required'], in_array( 'tools', array_column( $categories, 'slug' ), true ) );
