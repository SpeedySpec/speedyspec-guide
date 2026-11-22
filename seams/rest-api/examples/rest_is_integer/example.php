<?php
// Whether a value is an integer or a numeric string or float with no fraction.
return array( rest_is_integer( 5 ), rest_is_integer( '5' ), rest_is_integer( 5.0 ), rest_is_integer( 5.5 ), rest_is_integer( 'five' ) );
