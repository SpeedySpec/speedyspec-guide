<?php
// Sends the headers every admin page gets: the referrer policy (strict-origin-when-cross-origin, filtered by admin_referrer_policy) and X-Frame-Options.
add_filter( 'admin_referrer_policy', function ( $policy ) { echo "$policy\n"; return $policy; } );
wp_admin_headers();
return 'sent';
