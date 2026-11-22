<?php
// Adds an endpoint to the places in the mask, with its query var made public (or another name, or none).
add_rewrite_endpoint( 'print', EP_PERMALINK | EP_PAGES );
add_rewrite_endpoint( 'json', EP_ROOT, 'format' );
return array( $GLOBALS['wp_rewrite']->endpoints, in_array( 'print', $GLOBALS['wp']->public_query_vars, true ), in_array( 'format', $GLOBALS['wp']->public_query_vars, true ) );
