<?php
// The registered category, or null with a notice.
add_action( 'wp_abilities_api_categories_init', fn() => wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) ) );
return array( wp_get_ability_category( 'tools' )->get_label(), wp_get_ability_category( 'none' ) );
