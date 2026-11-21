<?php
// After: remove the callbacks of each hook you own.
add_filter( 'guide_x', 'strtoupper' );
remove_all_filters( 'guide_x' );

return has_filter( 'guide_x' );
