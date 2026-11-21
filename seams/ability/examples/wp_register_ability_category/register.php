<?php
// Categories are registered on wp_abilities_api_categories_init; wp_register_ability_category_args filters their properties.
add_filter( 'wp_register_ability_category_args', fn( $args, $slug ) => $args + array( 'meta' => array( 'by' => 'filter' ) ), 10, 2 );
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
$category = wp_get_ability_category( 'tools' );
return array( $category->get_slug(), $category->get_label(), $category->get_description(), $category->get_meta() );
