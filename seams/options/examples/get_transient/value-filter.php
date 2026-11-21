<?php
// transient_{$transient} filters the value read.
set_transient( 'guide_t', 'v' );
add_filter( 'transient_guide_t', fn( $value ) => "$value!" );
return get_transient( 'guide_t' );
