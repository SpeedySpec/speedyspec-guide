<?php
// After: count from a point by subtracting, instead of resetting.
do_action( 'guide_a' );
$before = did_action( 'guide_a' );
do_action( 'guide_a' );

return did_action( 'guide_a' ) - $before;
