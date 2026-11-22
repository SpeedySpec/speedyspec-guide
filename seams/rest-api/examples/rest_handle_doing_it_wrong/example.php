<?php
// Hooked to doing_it_wrong_run while serving a REST request: with WP_DEBUG and headers not yet sent, reports the call in an X-WP-DoingItWrong header instead of a notice; otherwise does nothing.
return array( WP_DEBUG, rest_handle_doing_it_wrong( 'some_function', 'Call it later.', '6.0.0' ) );
