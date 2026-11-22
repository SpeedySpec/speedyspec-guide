<?php
// sanitize_text_field gets the result and the original.
add_filter( 'sanitize_text_field', fn( $filtered, $str ) => "[$filtered]", 10, 2 );
return sanitize_text_field( ' a ' );
