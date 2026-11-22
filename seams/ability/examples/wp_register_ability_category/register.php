<?php
// Categories are registered on wp_abilities_api_categories_init; wp_register_ability_category_args filters their properties.
function guide_add_category_meta( $args, $slug ) {
	return $args + array( 'meta' => array( 'by' => 'filter' ) );
}
add_filter( 'wp_register_ability_category_args', 'guide_add_category_meta', 10, 2 );
function guide_register_tools_category() {
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) );
}
add_action( 'wp_abilities_api_categories_init', 'guide_register_tools_category' );
$category = wp_get_ability_category( 'tools' );
return array( $category->get_slug(), $category->get_label(), $category->get_description(), $category->get_meta() );
