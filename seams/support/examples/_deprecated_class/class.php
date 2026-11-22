<?php
// Reports a deprecated class: fires deprecated_class_run, then raises a notice when debugging allows it.
function guide_print_deprecated_class( $class, $replacement, $version ) {
	echo "$class is deprecated since $version for $replacement\n";
}
add_action( 'deprecated_class_run', 'guide_print_deprecated_class', 10, 3 );
_deprecated_class( 'Old_Class', '6.4.0', 'New_Class' );
return 'reported';
