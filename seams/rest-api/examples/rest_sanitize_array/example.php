<?php
// A value as a list: a comma-separated string split, an array's values; anything else an empty array.
return array( rest_sanitize_array( 'a, b' ), rest_sanitize_array( array( 'x' => 1, 'y' => 2 ) ), rest_sanitize_array( 3 ) );
