<?php
// Removes a category and returns it; an unknown slug gives null with a notice.
function guide_register_tools_category() {
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) );
}
add_action( 'wp_abilities_api_categories_init', 'guide_register_tools_category' );
return array( wp_unregister_ability_category( 'tools' )->get_slug(), wp_has_ability_category( 'tools' ), wp_unregister_ability_category( 'tools' ) );
