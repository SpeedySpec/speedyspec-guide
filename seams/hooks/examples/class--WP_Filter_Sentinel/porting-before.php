<?php
// Before: a sentinel as the default value of a filter.
$sentinel = new WP_Filter_Sentinel();

return apply_filters( 'guide_sentinel', $sentinel ) === $sentinel;
