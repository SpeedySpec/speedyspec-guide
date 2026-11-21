<?php
// The key a callback is stored under: its name, or Class::method for a static method.
return array(
	_wp_filter_build_unique_id( 'guide', 'strtoupper', 10 ),
	_wp_filter_build_unique_id( 'guide', array( 'Guide_Class', 'method' ), 10 ),
	_wp_filter_build_unique_id( 'guide', 'Guide_Class::method', 10 ),
);
