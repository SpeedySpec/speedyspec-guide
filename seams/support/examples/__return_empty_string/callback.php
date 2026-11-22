<?php
// Always an empty string, for use as a callback that answers a filter.
add_filter( 'guide_value', '__return_empty_string' );
return array( __return_empty_string(), apply_filters( 'guide_value', 'x' ) );
