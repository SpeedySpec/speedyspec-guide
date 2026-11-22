<?php
// Hooked to rest_index: adds the application passwords authorization URL to the index's authentication data, when they are available.
add_filter( 'wp_is_application_passwords_available', '__return_true' );
$response = rest_add_application_passwords_to_index( new WP_REST_Response( array( 'authentication' => array() ) ) );
return $response->get_data()['authentication']['application-passwords']['endpoints'] ?? 'not available over plain HTTP';
