<?php
// prefetch and conservative, unless WP_SPECULATIVE_LOADING_DEFAULT_MODE and _EAGERNESS (environment or constant) give valid values.
$before = wp_get_speculation_rules_default_configuration();
define( 'WP_SPECULATIVE_LOADING_DEFAULT_MODE', 'prerender' );
define( 'WP_SPECULATIVE_LOADING_DEFAULT_EAGERNESS', 'immediate' );
return array( $before, wp_get_speculation_rules_default_configuration() );
