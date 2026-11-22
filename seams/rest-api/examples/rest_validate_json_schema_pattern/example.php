<?php
// Whether a value matches a JSON Schema pattern, which needs no delimiters.
return array( rest_validate_json_schema_pattern( '^[a-z]+$', 'abc' ), rest_validate_json_schema_pattern( '^[a-z]+$', 'ab1' ), rest_validate_json_schema_pattern( '#', 'a#b' ) );
