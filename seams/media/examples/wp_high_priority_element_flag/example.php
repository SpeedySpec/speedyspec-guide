<?php
// Whether an element may still get fetchpriority="high": sets the flag when given a value, gives it either way.
$before = wp_high_priority_element_flag();
wp_high_priority_element_flag( false );
return array( $before, wp_high_priority_element_flag() );
