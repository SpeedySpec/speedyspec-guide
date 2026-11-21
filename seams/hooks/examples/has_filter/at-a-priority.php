<?php
// With a priority too, it says whether the callback is at that priority.
add_filter( 'guide_h', 'strtoupper', 15 );

return array( has_filter( 'guide_h', 'strtoupper', 15 ), has_filter( 'guide_h', 'strtoupper', 10 ) );
