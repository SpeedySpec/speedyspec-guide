<?php
// On trunk, wp_random_base comes back without a trailing slash too.
add_option( 'wp_random_base', '/random/' );
return get_option( 'wp_random_base' );
