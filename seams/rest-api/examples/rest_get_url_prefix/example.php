<?php
// The URL prefix of the REST API, wp-json, filtered by rest_url_prefix.
$plain = rest_get_url_prefix();
add_filter( 'rest_url_prefix', fn() => 'api' );
return array( $plain, rest_get_url_prefix() );
