<?php
// Reports a PHP 4 style constructor: fires deprecated_constructor_run, then raises a notice when debugging allows it.
function guide_print_deprecated_constructor( $class, $version, $parent ) {
	echo "$class constructor is deprecated since $version\n";
}
add_action( 'deprecated_constructor_run', 'guide_print_deprecated_constructor', 10, 3 );
_deprecated_constructor( 'Old_Widget', '4.3.0' );
return 'reported';
