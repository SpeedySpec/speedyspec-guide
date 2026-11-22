<?php
// The fourth argument of add_option() decides whether the option loads with every request, in one query.
add_option( 'guide_small', 'loaded on every request' );
add_option( 'guide_rarely_used', str_repeat( 'x', 100 ), '', false );
$all = wp_load_alloptions();
return array( isset( $all['guide_small'] ), isset( $all['guide_rarely_used'] ), get_option( 'guide_rarely_used' ) === str_repeat( 'x', 100 ) );
