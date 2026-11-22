<?php
// Whether a path uses a stream wrapper PHP has registered.
return array( wp_is_stream( 'php://memory' ), wp_is_stream( 'nope://x' ), wp_is_stream( '/var/www' ) );
