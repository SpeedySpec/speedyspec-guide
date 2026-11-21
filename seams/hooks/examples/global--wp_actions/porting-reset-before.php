<?php
// Before: resetting the counts by replacing $wp_actions.
do_action( 'guide_a' );
$GLOBALS['wp_actions'] = array();

return did_action( 'guide_a' );
