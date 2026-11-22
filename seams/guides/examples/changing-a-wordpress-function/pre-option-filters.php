<?php
// get_option() fires pre_option_{$option}, then pre_option with that result; anything but false is returned as is.
function guide_watch_pre_option_colour( $pre, $option, $default_value ) {
	echo esc_html( "pre_option_$option got default $default_value; " );
	return $pre;
}
function guide_answer_pre_option( $pre, $option ) {
	echo esc_html( "pre_option got $option; " );
	return 'guide_colour' === $option ? 'from pre_option' : $pre;
}
add_filter( 'pre_option_guide_colour', 'guide_watch_pre_option_colour', 10, 3 );
add_filter( 'pre_option', 'guide_answer_pre_option', 10, 2 );
return get_option( 'guide_colour', 'grey' );
