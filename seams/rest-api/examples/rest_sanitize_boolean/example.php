<?php
// A request value as a boolean: 'false', '0' and '' are false.
return array( rest_sanitize_boolean( 'false' ), rest_sanitize_boolean( '0' ), rest_sanitize_boolean( 'yes' ), rest_sanitize_boolean( 1 ) );
