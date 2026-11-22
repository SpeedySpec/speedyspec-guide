<?php
// The registered category, or null with a notice.
function guide_register_tools_category() {
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'Small tools.' ) );
}
add_action( 'wp_abilities_api_categories_init', 'guide_register_tools_category' );
return array( wp_get_ability_category( 'tools' )->get_label(), wp_get_ability_category( 'none' ) );
