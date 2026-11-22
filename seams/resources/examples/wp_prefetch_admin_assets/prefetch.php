<?php
// Prints prefetch links for the assets of the next likely screen (the new post editor from the dashboard or a posts list, or the dashboard from the login page), when the user may go there.
set_current_screen( 'dashboard' );
$html = guide_render( 'wp_prefetch_admin_assets' );
preg_match_all( "/as='([a-z]+)'/", $html, $m );
return array_count_values( $m[1] );
