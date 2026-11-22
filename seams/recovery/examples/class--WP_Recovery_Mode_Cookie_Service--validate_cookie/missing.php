<?php
// Without a cookie given or set, validate_cookie() and get_session_id_from_cookie() report no cookie.
$service = new WP_Recovery_Mode_Cookie_Service();
return array( $service->is_cookie_set(), $service->validate_cookie()->get_error_code(), $service->get_session_id_from_cookie()->get_error_code() );
