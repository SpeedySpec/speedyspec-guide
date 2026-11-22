<?php
// Whether a value reads as a boolean in a request: true, false, 'true', 'false', '1', '0', 1, 0 or ''.
return array( rest_is_boolean( 'false' ), rest_is_boolean( 1 ), rest_is_boolean( 'yes' ) );
