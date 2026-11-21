<?php
// A callback that was never added is false.
add_filter( 'guide_h', 'strtoupper' );

return has_filter( 'guide_h', 'strtolower' );
