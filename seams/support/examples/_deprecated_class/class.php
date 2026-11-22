<?php
// Reports a deprecated class: fires deprecated_class_run, then raises a notice when debugging allows it.
add_action( 'deprecated_class_run', fn( $class, $replacement, $version ) => print( "$class is deprecated since $version for $replacement\n" ), 10, 3 );
_deprecated_class( 'Old_Class', '6.4.0', 'New_Class' );
return 'reported';
