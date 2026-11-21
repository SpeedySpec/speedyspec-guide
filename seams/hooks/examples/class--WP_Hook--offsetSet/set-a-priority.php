<?php
// Setting a priority replaces its callbacks.
$hook       = new WP_Hook();
$hook[20] = array( 'k' => array( 'function' => 'strtoupper', 'accepted_args' => 1 ) );

return $hook->apply_filters( 'a', array( 'a' ) );
