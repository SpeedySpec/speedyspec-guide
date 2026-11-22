<?php
// A redirect location when its host is the site's or an allowed one; otherwise the fallback.
function guide_allow_partner_host( $hosts ) {
	return array_merge( $hosts, array( 'partner.example' ) );
}
add_filter( 'allowed_redirect_hosts', 'guide_allow_partner_host' );
return array( wp_validate_redirect( 'http://example.org/a' ), wp_validate_redirect( 'https://evil.example/', 'fallback' ), wp_validate_redirect( 'https://partner.example/x' ), wp_validate_redirect( '//evil.example', '' ) );
