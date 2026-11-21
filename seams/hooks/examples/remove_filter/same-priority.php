<?php
// Removing needs the priority the callback was added at.
add_filter( 'guide_up', 'strtoupper', 20 );

return array( remove_filter( 'guide_up', 'strtoupper' ), remove_filter( 'guide_up', 'strtoupper', 20 ) );
