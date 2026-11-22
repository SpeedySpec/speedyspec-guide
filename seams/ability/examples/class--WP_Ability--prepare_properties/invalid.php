<?php
// Missing or wrong properties throw: no execute callback, no permission check, bad capabilities, a schema or meta that isn't an array.
$base = array( 'label' => 'X', 'description' => 'D.', 'category' => 'tools' );
foreach ( array(
	array(),
	array( 'execute_callback' => '__return_true' ),
	array( 'execute_callback' => '__return_true', 'required_capabilities' => array( '' ) ),
	array( 'execute_callback' => '__return_true', 'permission_callback' => 'nope_not_callable' ),
	array( 'execute_callback' => '__return_true', 'permission_callback' => '__return_true', 'input_schema' => 'x' ),
	array( 'execute_callback' => '__return_true', 'permission_callback' => '__return_true', 'meta' => array( 'public' => 'yes' ) ),
) as $extra ) {
	try { new WP_Ability( 'guide/x', $base + $extra ); } catch ( InvalidArgumentException $e ) { echo $e->getMessage(), "\n"; }
}
return null;
