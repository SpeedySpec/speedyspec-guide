<?php
// Turn hooks given as plain arrays (before WordPress loads) into WP_Hook objects.
$hooks = WP_Hook::build_preinitialized_hooks(
	array(
		'guide' => array( 10 => array( array( 'function' => 'strtoupper', 'accepted_args' => 1 ) ) ),
	)
);

return $hooks['guide']->apply_filters( 'a', array( 'a' ) );
