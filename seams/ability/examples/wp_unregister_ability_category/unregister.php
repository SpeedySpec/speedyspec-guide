<?php
// Removes a category and returns it; an unknown slug gives null with a notice.
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
return array( wp_unregister_ability_category( 'tools' )->get_slug(), wp_has_ability_category( 'tools' ), wp_unregister_ability_category( 'tools' ) );
