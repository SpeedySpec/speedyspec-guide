<?php
// With a shortcode name, shortcode_atts_{$shortcode} can change the result.
add_filter( 'shortcode_atts_greet', function ( $out ) { $out['size'] = 'l'; return $out; } );
return shortcode_atts( array( 'size' => 'm' ), array(), 'greet' );
