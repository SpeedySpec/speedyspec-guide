<?php
// Remove every callback on a hook.
add_filter( 'guide_x', 'strtoupper' );
add_filter( 'guide_x', 'trim', 5 );
remove_all_filters( 'guide_x' );

return has_filter( 'guide_x' );
