<?php
// Inside a callback, it names the running hook.
add_filter( 'guide_which', fn( $v ) => current_filter() );

return apply_filters( 'guide_which', 'v' );
