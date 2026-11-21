<?php
// The attributes whose values are URLs, and get checked for allowed protocols.
$uri = wp_kses_uri_attributes();
return array( in_array( 'href', $uri, true ), in_array( 'src', $uri, true ), in_array( 'title', $uri, true ) );
