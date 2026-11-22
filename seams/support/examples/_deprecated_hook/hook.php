<?php
// Reports a deprecated hook that has callbacks: fires deprecated_hook_run, then raises a notice when debugging allows it.
function guide_print_deprecated_hook( $hook, $replacement, $version ) {
	echo "$hook is deprecated since $version for $replacement\n";
}
add_action( 'deprecated_hook_run', 'guide_print_deprecated_hook', 10, 3 );
_deprecated_hook( 'old_hook', '6.1.0', 'new_hook' );
return 'reported';
