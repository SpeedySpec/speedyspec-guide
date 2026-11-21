<?php
// Change a value WordPress passes through a filter.
add_filter( 'excerpt_length', fn() => 20, 999 );

return apply_filters( 'excerpt_length', 55 );
