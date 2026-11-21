<?php
// wp_max_autoloaded_option_size changes the limit.
add_filter( 'wp_max_autoloaded_option_size', fn() => 10 );
return wp_filter_default_autoload_value_via_option_size( null, 'guide', 'v', 'eleven char' );
