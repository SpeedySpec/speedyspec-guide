<?php
// After: add the callbacks with add_filter() (or set $wp_filter arrays before WordPress loads).
add_filter( 'guide_b', 'strtoupper' );

return apply_filters( 'guide_b', 'a' );
