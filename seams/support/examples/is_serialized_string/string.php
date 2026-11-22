<?php
// Whether a value is a serialized string value (s:N:"...";).
return array( is_serialized_string( 's:3:"abc";' ), is_serialized_string( 'a:0:{}' ) );
