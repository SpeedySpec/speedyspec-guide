<?php
// Whether a value reads as an array: an array or a comma-separated string.
return array( rest_is_array( 'a,b' ), rest_is_array( array( 1 ) ), rest_is_array( 3 ) );
