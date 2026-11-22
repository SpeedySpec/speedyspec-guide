<?php
// Reports a PHP 4 style constructor: fires deprecated_constructor_run, then raises a notice when debugging allows it.
add_action( 'deprecated_constructor_run', fn( $class, $version, $parent ) => print( "$class constructor is deprecated since $version\n" ), 10, 3 );
_deprecated_constructor( 'Old_Widget', '4.3.0' );
return 'reported';
