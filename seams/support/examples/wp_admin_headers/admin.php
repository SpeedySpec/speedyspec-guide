<?php
// Sends the headers every admin page gets: the referrer policy (strict-origin-when-cross-origin, filtered by admin_referrer_policy) and X-Frame-Options.
function guide_print_referrer_policy( $policy ) {
	echo "$policy\n";
	return $policy;
}
add_filter( 'admin_referrer_policy', 'guide_print_referrer_policy' );
wp_admin_headers();
return 'sent';
