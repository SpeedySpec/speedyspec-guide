<?php
// register_setting_args can change the arguments before they are stored.
add_filter( 'register_setting_args', function ( $args ) {
	$args['show_in_rest'] = true;
	return $args;
} );
register_setting( 'guide', 'guide_color' );
return get_registered_settings()['guide_color']['show_in_rest'];
