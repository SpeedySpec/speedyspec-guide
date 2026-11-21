<?php
// After: any fresh object is unique by identity too; use the sentinel only where it exists.
$sentinel = class_exists( 'WP_Filter_Sentinel' ) ? new WP_Filter_Sentinel() : new stdClass();

return apply_filters( 'guide_sentinel', $sentinel ) === $sentinel;
