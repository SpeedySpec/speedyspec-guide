<?php
// Each hook name holds a WP_Hook.
add_filter( 'guide_g', 'trim' );

return $GLOBALS['wp_filter']['guide_g'] instanceof WP_Hook;
