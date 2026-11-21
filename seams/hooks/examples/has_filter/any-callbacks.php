<?php
// Without a callback, it says whether the hook has any.
$before = has_filter( 'guide_h' );
add_filter( 'guide_h', 'strtoupper' );

return array( $before, has_filter( 'guide_h' ) );
