<?php
// A URL (the current one by default) without some query arguments.
return array( remove_query_arg( 'a', 'http://example.org/?a=1&b=2' ), remove_query_arg( array( 'a', 'b' ), 'http://example.org/?a=1&b=2&c=3' ) );
