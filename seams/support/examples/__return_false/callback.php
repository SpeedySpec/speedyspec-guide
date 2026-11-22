<?php
// Always false, for use as a callback that answers a filter.
add_filter( 'guide_value', '__return_false' );
return array( __return_false(), apply_filters( 'guide_value', 'x' ) );
