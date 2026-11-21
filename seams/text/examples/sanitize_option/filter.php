<?php
// Every option, known or not, then goes through sanitize_option_{$option}, with the option name and the value given.
add_filter( 'sanitize_option_guide', fn( $value, $option, $original ) => "$option=$value", 10, 3 );
return sanitize_option( 'guide', 'x' );
