<?php
// Always 0, for use as a callback that answers a filter.
add_filter( 'guide_value', '__return_zero' );
return array( __return_zero(), apply_filters( 'guide_value', 'x' ) );
