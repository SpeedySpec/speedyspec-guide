<?php
// Always true, for use as a callback that answers a filter.
add_filter( 'guide_value', '__return_true' );
return array( __return_true(), apply_filters( 'guide_value', 'x' ) );
