<?php
// After: count from a point by subtracting, instead of resetting.
apply_filters( 'guide_f', 'v' );
$before = did_filter( 'guide_f' );
apply_filters( 'guide_f', 'v' );

return did_filter( 'guide_f' ) - $before;
