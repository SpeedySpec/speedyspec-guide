<?php
// One component of a parsed URL by PHP_URL_ constant, or all with -1; _wp_translate_php_url_constant_to_key() maps the constant to its key.
$parts = wp_parse_url( 'https://example.org/x?y' );
return array( _get_component_from_parsed_url_array( $parts, PHP_URL_HOST ), _get_component_from_parsed_url_array( $parts, PHP_URL_PORT ), _get_component_from_parsed_url_array( $parts ), _wp_translate_php_url_constant_to_key( PHP_URL_QUERY ), _wp_translate_php_url_constant_to_key( 99 ) );
