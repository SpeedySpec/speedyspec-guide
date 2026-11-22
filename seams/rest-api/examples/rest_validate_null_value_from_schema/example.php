<?php
// Validates a value against the null type.
return array( rest_validate_null_value_from_schema( null, 'x' ), rest_validate_null_value_from_schema( '', 'x' )->get_error_message() );
