<?php
// Checks site data into a WP_Error: a domain, path and network are needed, dates must be valid, and the domain and path must not be taken.
$errors = new WP_Error();
wp_validate_site_data( $errors, array( 'domain' => '', 'path' => '/', 'network_id' => 1, 'registered' => 'nope', 'last_updated' => '2026-03-01 09:00:00' ) );
return $errors->get_error_codes();
