<?php
// Hooked to init: adds the REST rewrite rules and the rest_route query variable, so /wp-json/ URLs reach the API.
global $wp;
rest_api_init();
return array( in_array( 'rest_route', $wp->public_query_vars, true ), rest_get_url_prefix() );
