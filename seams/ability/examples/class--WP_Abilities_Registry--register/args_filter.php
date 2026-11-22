<?php
// wp_register_ability_args filters the properties first; ability_class picks a subclass of WP_Ability, and anything else is refused.
class Guide_Ability extends WP_Ability {}
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
add_filter( 'wp_register_ability_args', fn( $args, $name ) => $args + array( 'ability_class' => Guide_Ability::class ), 10, 2 );
add_action( 'wp_abilities_api_init', function ( $registry ) {
	$registry->register( 'guide/sub', array( 'label' => 'Sub', 'description' => 'D.', 'category' => 'tools', 'permission_callback' => '__return_true' ) );
	$registry->register( 'guide/bad', array( 'label' => 'Bad', 'description' => 'D.', 'category' => 'tools', 'ability_class' => 'stdClass' ) );
	$registry->register( 'guide/sub', array() );
} );
$registry = WP_Abilities_Registry::get_instance();
return array( get_class( $registry->get_registered( 'guide/sub' ) ), array_keys( $registry->get_all_registered() ), $registry->is_registered( 'guide/bad' ) );
