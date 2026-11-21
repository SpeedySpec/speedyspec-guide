<?php
// Removes the query args that the URL doesn't have from a query string.
return array( _remove_qs_args_if_not_in_url( '?a=1&b=2', array( 'a', 'b' ), 'http://example.org/?a=5' ), _remove_qs_args_if_not_in_url( '?a=1&b=2', array( 'a' ), 'http://example.org/' ) );
