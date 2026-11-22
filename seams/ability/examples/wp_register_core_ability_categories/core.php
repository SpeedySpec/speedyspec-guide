<?php
// WordPress's own categories: site, user and content.
add_action( 'wp_abilities_api_categories_init', 'wp_register_core_ability_categories' );
return array_map( fn( $c ) => $c->get_label(), wp_get_ability_categories() );
