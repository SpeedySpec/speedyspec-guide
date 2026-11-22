<?php
// expiration_of_transient_{$transient} changes the expiration, here to none.
function guide_never_expire( $expiration ) {
	return 0;
}
add_filter( 'expiration_of_transient_guide_t', 'guide_never_expire' );
set_transient( 'guide_t', 'v', 60 );
return get_option( '_transient_timeout_guide_t' );
