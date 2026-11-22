<?php
// Always null, for use as a callback that answers a filter.
add_filter( 'guide_value', '__return_null' );
return array( __return_null(), apply_filters( 'guide_value', 'x' ) );
