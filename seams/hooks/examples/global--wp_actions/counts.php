<?php
// Each action name counts how often it fired.
do_action( 'guide_a' );
do_action( 'guide_a' );

return $GLOBALS['wp_actions']['guide_a'];
