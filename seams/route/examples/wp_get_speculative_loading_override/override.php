<?php
// The value of an environment variable or, over it, a string constant of that name; null when neither is set.
putenv( 'GUIDE_SPEC=env' );
$env = wp_get_speculative_loading_override( 'GUIDE_SPEC' );
define( 'GUIDE_SPEC', 'constant' );
return array( $env, wp_get_speculative_loading_override( 'GUIDE_SPEC' ), wp_get_speculative_loading_override( 'GUIDE_NONE' ) );
