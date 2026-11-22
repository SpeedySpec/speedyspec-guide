<?php
// Hooked to deprecated_argument_run while serving a REST request: with WP_DEBUG and headers not yet sent, reports the argument in an X-WP-DeprecatedParam header instead of a notice; otherwise does nothing.
return array( WP_DEBUG, rest_handle_deprecated_argument( 'some_function', 'The $x argument is gone.', '6.0.0' ) );
