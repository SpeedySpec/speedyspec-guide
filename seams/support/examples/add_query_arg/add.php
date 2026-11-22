<?php
// A URL (the current one by default) with query arguments added or replaced, from a key and value or an array; false values remove the key.
$_SERVER['REQUEST_URI'] = '/page?x=1';
return array( add_query_arg( 'p', 5, 'http://example.org/?a=1#top' ), add_query_arg( array( 'a' => false, 'b' => 'two' ), 'http://example.org/?a=1' ), add_query_arg( 'y', 2 ) );
