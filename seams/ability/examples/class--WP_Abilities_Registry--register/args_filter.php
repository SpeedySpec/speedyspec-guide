<?php
// wp_register_ability_args filters the properties first; ability_class picks a subclass of WP_Ability, and anything else is refused.
class Guide_Ability extends WP_Ability {}
function guide_register_tools_category() {
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) );
}
add_action( 'wp_abilities_api_categories_init', 'guide_register_tools_category' );
function guide_use_ability_subclass( $args, $name ) {
	return $args + array( 'ability_class' => Guide_Ability::class );
}
add_filter( 'wp_register_ability_args', 'guide_use_ability_subclass', 10, 2 );
function guide_register_abilities( $registry ) {
	$registry->register( 'guide/sub', array( 'label' => 'Sub', 'description' => 'D.', 'category' => 'tools', 'permission_callback' => '__return_true' ) );
	$registry->register( 'guide/bad', array( 'label' => 'Bad', 'description' => 'D.', 'category' => 'tools', 'ability_class' => 'stdClass' ) );
	$registry->register( 'guide/sub', array() );
}
add_action( 'wp_abilities_api_init', 'guide_register_abilities' );
$registry = WP_Abilities_Registry::get_instance();
return array( get_class( $registry->get_registered( 'guide/sub' ) ), array_keys( $registry->get_all_registered() ), $registry->is_registered( 'guide/bad' ) );
