<?php
// Reports a deprecated hook that has callbacks: fires deprecated_hook_run, then raises a notice when debugging allows it.
add_action( 'deprecated_hook_run', fn( $hook, $replacement, $version ) => print( "$hook is deprecated since $version for $replacement\n" ), 10, 3 );
_deprecated_hook( 'old_hook', '6.1.0', 'new_hook' );
return 'reported';
