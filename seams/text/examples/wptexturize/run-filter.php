<?php
// run_wptexturize turns it off.
add_filter( 'run_wptexturize', '__return_false' );
return wptexturize( '"Hi"' );
