<?php
// true and 'yes' become 'on'; false and 'no' become 'off'; null leaves it to wp_default_autoload_value.
$results = array();
foreach ( array( true, false, 'yes', 'no', null ) as $autoload ) {
	$results[] = wp_determine_option_autoload_value( 'guide', 'v', 's:1:"v";', $autoload );
}
return $results;
