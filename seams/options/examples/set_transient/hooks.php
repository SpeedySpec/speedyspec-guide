<?php
// The filters and actions set_transient() fires, in order.
add_filter( 'pre_set_transient_guide_t', function ( $value ) { echo 'pre_set_transient_guide_t '; return $value; } );
add_filter( 'expiration_of_transient_guide_t', function ( $expiration ) { echo 'expiration_of_transient_guide_t '; return $expiration; } );
add_action( 'set_transient_guide_t', function () { echo 'set_transient_guide_t '; } );
add_action( 'set_transient', function () { echo 'set_transient '; } );
return set_transient( 'guide_t', 'v', 60 );
