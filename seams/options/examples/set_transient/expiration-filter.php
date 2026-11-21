<?php
// expiration_of_transient_{$transient} changes the expiration, here to none.
add_filter( 'expiration_of_transient_guide_t', fn() => 0 );
set_transient( 'guide_t', 'v', 60 );
return get_option( '_transient_timeout_guide_t' );
