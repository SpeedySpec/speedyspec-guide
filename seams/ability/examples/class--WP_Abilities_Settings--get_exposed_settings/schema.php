<?php
// Only settings with show_in_abilities are exposed; show_in_abilities (or show_in_rest) can rename one and add to its schema, which gets its label and description.
guide_core_abilities();
function guide_blogname( $pre ) {
	return 'Guide';
}
add_filter( 'pre_option_blogname', 'guide_blogname' );
function guide_posts_per_page( $pre ) {
	return '10';
}
add_filter( 'pre_option_posts_per_page', 'guide_posts_per_page' );
function guide_flag_option( $pre ) {
	return '';
}
add_filter( 'pre_option_guide_flag', 'guide_flag_option' );
register_setting( 'general', 'blogname', array( 'show_in_abilities' => true, 'type' => 'string', 'label' => 'Site Title' ) );
register_setting( 'reading', 'posts_per_page', array( 'show_in_abilities' => array( 'name' => 'per_page' ), 'type' => 'integer' ) );
register_setting( 'reading', 'guide_flag', array( 'show_in_abilities' => true, 'type' => 'boolean' ) );
register_setting( 'general', 'guide_hidden', array( 'type' => 'string' ) );
function guide_grant_manage_options( $allcaps ) {
	return $allcaps + array( 'manage_options' => true );
}
add_filter( 'user_has_cap', 'guide_grant_manage_options' );
$ability = wp_get_ability( 'core/settings-get' );
return array( $ability->get_input_schema()['properties'], $ability->get_output_schema()['properties'] );
