<?php
// Hooked to rest_api_init: adds the filters serving needs (CORS headers, the Allow header, _fields, OPTIONS answers, the index's application passwords), and while serving a REST request turns deprecation notices into response headers.
rest_api_default_filters();
return array( has_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' ), has_filter( 'rest_post_dispatch', 'rest_filter_response_fields' ), has_filter( 'rest_pre_dispatch', 'rest_handle_options_request' ), has_action( 'deprecated_function_run', 'rest_handle_deprecated_function' ) );
