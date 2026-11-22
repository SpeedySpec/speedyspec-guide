<?php
// wp_pre_execute_ability can answer instead; wp_ability_execute_result filters the callback's result, and an exception in the callback becomes an error.
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
add_action( 'wp_abilities_api_init', fn() => wp_register_ability( 'guide/throw', array( 'label' => 'T', 'description' => 'D.', 'category' => 'tools', 'execute_callback' => function () { throw new RuntimeException( 'boom' ); }, 'permission_callback' => '__return_true' ) ) );
$ability = wp_get_ability( 'guide/throw' );
$error = $ability->execute();
add_filter( 'wp_pre_execute_ability', fn( $pre, $name ) => 'guide/throw' === $name ? 'answered' : $pre, 10, 2 );
return array( $error->get_error_code(), $error->get_error_message(), $ability->execute() );
