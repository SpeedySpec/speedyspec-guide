<?php
// A query string from an array, like http_build_query(), encoded by urlencode() unless told not to; nested arrays get bracketed keys and null values are left out.
return array( _http_build_query( array( 'a' => 'x y', 'n' => null, 'c' => array( 'k' => 1 ) ), null, '&' ), _http_build_query( array( 'a' => 'x y' ), null, '&', '', false ) );
