<?php
// Only $accepted_args arguments reach the callback.
add_filter( 'guide_count', function ( ...$args ) {
	return count( $args );
} );

return apply_filters( 'guide_count', 'value', 'extra', 'more' );
