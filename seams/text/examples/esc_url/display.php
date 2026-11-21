<?php
// Display context: removes characters URLs can't have, encodes & and ', adds http:// to a bare host, and refuses a protocol not allowed.
return array( esc_url( 'example.com/a b?x=1&y=\'2\'' ), esc_url( 'javascript:alert(1)' ), esc_url( '/path?a=[1]' ), esc_url( '' ) );
