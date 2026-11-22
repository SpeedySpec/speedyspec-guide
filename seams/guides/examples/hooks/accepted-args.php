<?php
// A callback receives only as many arguments as add_filter()'s fourth argument allows: one by default.
function guide_count_arguments( ...$args ) {
	return count( $args );
}
add_filter( 'guide_count', 'guide_count_arguments' );
return apply_filters( 'guide_count', 'value', 'extra', 'more' );
