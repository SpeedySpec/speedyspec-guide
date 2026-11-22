<?php
// A string as valid UTF-8, converted from its detected encoding (or with invalid bytes removed when mbstring is missing).
return array( _wp_json_convert_string( 'plain' ), bin2hex( _wp_json_convert_string( "\xB1" ) ) );
