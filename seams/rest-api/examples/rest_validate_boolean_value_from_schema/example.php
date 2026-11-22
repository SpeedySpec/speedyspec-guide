<?php
// Validates a value against the boolean type.
return array( rest_validate_boolean_value_from_schema( 'true', 'on' ), rest_validate_boolean_value_from_schema( 'maybe', 'on' )->get_error_message() );
