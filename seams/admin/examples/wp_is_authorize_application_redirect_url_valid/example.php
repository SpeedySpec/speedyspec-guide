<?php
// Checks an application's redirect URL: HTTPS, or HTTP on a local environment, and not a javascript: or data: URL; gives true or an error.
return array( wp_is_authorize_application_redirect_url_valid( 'https://app.example.org/done' ), wp_is_authorize_application_redirect_url_valid( 'javascript:alert(1)' )->get_error_code() );
