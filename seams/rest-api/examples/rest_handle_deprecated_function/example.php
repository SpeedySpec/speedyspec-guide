<?php
// Hooked to deprecated_function_run while serving a REST request: with WP_DEBUG and headers not yet sent, reports the function in an X-WP-DeprecatedFunction header instead of a notice; otherwise does nothing.
return array( WP_DEBUG, rest_handle_deprecated_function( 'old_thing', 'new_thing', '6.0.0' ) );
