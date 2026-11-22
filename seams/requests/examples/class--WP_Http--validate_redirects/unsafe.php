<?php
// On a redirect, an unsafe Location (failing wp_http_validate_url) throws, so the request fails; browser_redirect_compatibility() turns a 302 POST into a GET.
try { WP_Http::validate_redirects( 'http://127.0.0.1/' ); } catch ( WpOrg\Requests\Exception $e ) { $err = $e->getMessage(); }
WP_Http::validate_redirects( 'http://example.org/' );
return $err;
