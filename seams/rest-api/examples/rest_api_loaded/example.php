<?php
// Hooked to parse_request: when the request has a rest_route query variable, serves it through the REST server and stops; otherwise does nothing.
global $wp;
$wp->query_vars = array();
return array( rest_api_loaded(), defined( 'REST_REQUEST' ) );
