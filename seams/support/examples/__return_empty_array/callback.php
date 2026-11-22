<?php
// Always an empty array, for use as a callback that answers a filter.
add_filter( 'guide_value', '__return_empty_array' );
return array( __return_empty_array(), apply_filters( 'guide_value', 'x' ) );
