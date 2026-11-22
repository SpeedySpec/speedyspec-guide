<?php
// get_option() fires pre_option_{$option}, then pre_option with that result; anything but false is returned as is.
add_filter( 'pre_option_guide_colour', function ( $pre, $option, $default_value ) {
	echo "pre_option_$option got default $default_value; ";
	return $pre;
}, 10, 3 );
add_filter( 'pre_option', function ( $pre, $option ) {
	echo "pre_option got $option; ";
	return 'guide_colour' === $option ? 'from pre_option' : $pre;
}, 10, 2 );
return get_option( 'guide_colour', 'grey' );
