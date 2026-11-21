<?php
// Every required capability, then the permission callback; wp_ability_permission_result filters the result, and anything but a bool or an error is false.
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
add_action( 'wp_abilities_api_init', fn() => wp_register_ability( 'guide/admin', array( 'label' => 'A', 'description' => 'D.', 'category' => 'tools', 'execute_callback' => '__return_true', 'required_capabilities' => array( 'manage_options' ), 'permission_callback' => fn() => 'yes' ) ) );
$ability = wp_get_ability( 'guide/admin' );
$without = $ability->check_permissions();
add_filter( 'user_has_cap', fn( $all ) => $all + array( 'manage_options' => true ) );
$non_bool = $ability->check_permissions();
add_filter( 'wp_ability_permission_result', fn( $result ) => true );
return array( $without, $non_bool, $ability->check_permissions(), $ability->execute() );
