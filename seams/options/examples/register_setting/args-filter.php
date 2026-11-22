<?php
// register_setting_args can change the arguments before they are stored.
function guide_show_setting_in_rest( $args ) {
	$args['show_in_rest'] = true;
	return $args;
}
add_filter( 'register_setting_args', 'guide_show_setting_in_rest' );
register_setting( 'guide', 'guide_color' );
return get_registered_settings()['guide_color']['show_in_rest'];
