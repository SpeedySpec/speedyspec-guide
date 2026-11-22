<?php
// A WP_REST_Response for any value: responses and errors pass through, anything else becomes a response's data.
$made = rest_ensure_response( array( 'ok' => true ) );
$error = rest_ensure_response( new WP_Error( 'nope' ) );
return array( get_class( $made ), $made->get_data(), get_class( $error ) );
