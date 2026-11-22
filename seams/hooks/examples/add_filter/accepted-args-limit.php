<?php
// Only $accepted_args arguments reach the callback.
function guide_count_arguments( ...$args ) {
	return count( $args );
}
add_filter( 'guide_count', 'guide_count_arguments' );

return apply_filters( 'guide_count', 'value', 'extra', 'more' );
