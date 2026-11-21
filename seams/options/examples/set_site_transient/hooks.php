<?php
// The filters and actions set_site_transient() fires, in order.
add_filter( 'pre_set_site_transient_guide_t', function ( $value ) { echo 'pre_set_site_transient_guide_t '; return $value; } );
add_filter( 'expiration_of_site_transient_guide_t', function ( $expiration ) { echo 'expiration_of_site_transient_guide_t '; return $expiration; } );
add_action( 'set_site_transient_guide_t', function () { echo 'set_site_transient_guide_t '; } );
add_action( 'set_site_transient', function () { echo 'set_site_transient '; } );
return set_site_transient( 'guide_t', 'v', 60 );
