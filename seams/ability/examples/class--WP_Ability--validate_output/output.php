<?php
// The result is checked against the output schema; wp_ability_validate_output can change the verdict.
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
add_action( 'wp_abilities_api_init', fn() => wp_register_ability( 'guide/str', array( 'label' => 'S', 'description' => 'D.', 'category' => 'tools', 'output_schema' => array( 'type' => 'string' ), 'execute_callback' => fn() => 5, 'permission_callback' => '__return_true' ) ) );
$error = wp_get_ability( 'guide/str' )->execute();
add_filter( 'wp_ability_validate_output', fn() => true );
return array( $error->get_error_code(), $error->get_error_message(), wp_get_ability( 'guide/str' )->execute() );
