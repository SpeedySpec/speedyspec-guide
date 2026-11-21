<?php
// Every registered category, by slug.
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
return array_map( fn( $c ) => $c->get_label(), wp_get_ability_categories() );
