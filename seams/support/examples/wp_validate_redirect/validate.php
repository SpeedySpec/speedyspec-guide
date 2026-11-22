<?php
// A redirect location when its host is the site's or an allowed one; otherwise the fallback.
add_filter( 'allowed_redirect_hosts', fn( $hosts ) => array_merge( $hosts, array( 'partner.example' ) ) );
return array( wp_validate_redirect( 'http://example.org/a' ), wp_validate_redirect( 'https://evil.example/', 'fallback' ), wp_validate_redirect( 'https://partner.example/x' ), wp_validate_redirect( '//evil.example', '' ) );
