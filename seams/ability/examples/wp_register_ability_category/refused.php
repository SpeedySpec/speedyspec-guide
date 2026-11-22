<?php
// Outside the hook, with a bad slug, twice, or without a label it is refused with a notice.
wp_register_ability_category( 'early', array() );
add_action( 'wp_abilities_api_categories_init', function () {
	wp_register_ability_category( 'Bad Slug', array() );
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'D.' ) );
	wp_register_ability_category( 'tools', array( 'label' => 'Tools', 'description' => 'D.' ) );
	wp_register_ability_category( 'nolabel', array( 'description' => 'D.' ) );
} );
return array_keys( wp_get_ability_categories() );
