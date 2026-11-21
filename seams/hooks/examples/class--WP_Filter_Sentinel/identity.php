<?php
// Each sentinel is unique by identity, and a filter no callback changes returns the same one.
$a = new WP_Filter_Sentinel();
$b = new WP_Filter_Sentinel();

return array( $a === $b, apply_filters( 'guide_sentinel', $a ) === $a );
