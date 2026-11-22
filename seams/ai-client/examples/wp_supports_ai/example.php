<?php
// Whether the site uses WordPress's AI features: false when WP_AI_SUPPORT is defined false, else as wp_supports_ai filters it, true by default.
$default = wp_supports_ai();
add_filter( 'wp_supports_ai', '__return_false' );
return array( $default, wp_supports_ai() );
