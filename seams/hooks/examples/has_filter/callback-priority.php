<?php
// With a callback, it returns the callback's priority.
add_filter( 'guide_h', 'strtoupper', 15 );

return has_filter( 'guide_h', 'strtoupper' );
