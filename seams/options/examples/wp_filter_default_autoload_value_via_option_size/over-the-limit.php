<?php
// A serialized value over 150000 bytes gives false; a smaller one leaves $autoload as it was.
return array(
	wp_filter_default_autoload_value_via_option_size( null, 'guide', 'v', str_repeat( 'a', 150001 ) ),
	wp_filter_default_autoload_value_via_option_size( null, 'guide', 'v', 'short' ),
);
