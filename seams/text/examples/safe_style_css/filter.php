<?php
// safe_style_css filters the list of allowed properties.
add_filter( 'safe_style_css', function ( $props ) { $props[] = 'behavior'; return $props; } );
return safecss_filter_attr( 'behavior: none' );
