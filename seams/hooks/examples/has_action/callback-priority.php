<?php
// It returns an action callback's priority.
add_action( 'guide_a', 'strtoupper' );

return has_action( 'guide_a', 'strtoupper' );
