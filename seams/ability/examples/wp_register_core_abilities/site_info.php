<?php
// core/get-site-info returns get_bloginfo() fields, all or those asked for; it needs manage_options.
guide_core_abilities();
function guide_blogname( $pre ) {
	return 'Guide';
}
add_filter( 'pre_option_blogname', 'guide_blogname' );
function guide_blogdescription( $pre ) {
	return 'Just another guide';
}
add_filter( 'pre_option_blogdescription', 'guide_blogdescription' );
$ability = wp_get_ability( 'core/get-site-info' );
$refused = $ability->execute()->get_error_code();
function guide_grant_manage_options( $allcaps ) {
	return $allcaps + array( 'manage_options' => true );
}
add_filter( 'user_has_cap', 'guide_grant_manage_options' );
return array( $refused, $ability->execute( array( 'fields' => array( 'name', 'description', 'charset' ) ) ), $ability->execute( array( 'fields' => array( 'nope' ) ) )->get_error_code() );
