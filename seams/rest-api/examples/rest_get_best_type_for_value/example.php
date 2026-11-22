<?php
// The first of a schema's types a value fits, in the order array, object, integer, number, boolean, string, null.
return array( rest_get_best_type_for_value( '5', array( 'integer', 'string' ) ), rest_get_best_type_for_value( 'x', array( 'integer', 'string' ) ), rest_get_best_type_for_value( 'x', array( 'integer' ) ) );
