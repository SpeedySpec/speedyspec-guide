<?php
// The filter can remove values, but a value it adds is dropped.
add_filter( 'wp_autoload_values_to_autoload', fn( $values ) => array( 'on', 'extra' ) );
return wp_autoload_values_to_autoload();
