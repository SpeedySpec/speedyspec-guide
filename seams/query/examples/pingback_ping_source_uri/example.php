<?php
// Hooked to pingback_ping_source_uri: refuses a pingback source URL that fails wp_http_validate_url().
return array( pingback_ping_source_uri( 'http://127.0.0.1/' ), pingback_ping_source_uri( 'http://example.org/post' ) );
