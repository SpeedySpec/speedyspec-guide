<?php
// Running an ability: a read-only ability takes GET with its input in the query, others POST with input in the body (destructive ones DELETE); the input is validated against its schema and the output returned.
function guide_register_tools_category() {
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) );
}
function guide_add_one( $input ) {
	return $input['n'] + 1;
}
function guide_register_add_ability() {
	wp_register_ability( 'guide/add', array(
	'label' => 'Add one', 'description' => 'Adds one to a number.', 'category' => 'tools',
	'input_schema' => array( 'type' => 'object', 'properties' => array( 'n' => array( 'type' => 'integer' ) ), 'required' => array( 'n' ) ),
	'output_schema' => array( 'type' => 'integer' ),
	'execute_callback' => 'guide_add_one',
	'permission_callback' => '__return_true',
	'meta' => array( 'annotations' => array( 'readonly' => true ), 'show_in_rest' => true ),
	) );
}
add_action( 'wp_abilities_api_categories_init', 'guide_register_tools_category' );
add_action( 'wp_abilities_api_init', 'guide_register_add_ability' );
$request = new WP_REST_Request( 'GET', '/wp-abilities/v1/abilities/guide/add/run' );
$request->set_query_params( array( 'input' => array( 'n' => 41 ) ) );
$ok = rest_get_server()->dispatch( $request );
$wrong = guide_rest( 'POST', '/wp-abilities/v1/abilities/guide/add/run', array( 'input' => array( 'n' => 1 ) ) );
return array( $ok->get_status(), $ok->get_data(), $wrong[0], $wrong[1]['code'] );
