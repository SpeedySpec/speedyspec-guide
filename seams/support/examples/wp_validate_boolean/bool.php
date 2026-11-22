<?php
// A boolean from a value, where the string false (any case) is false.
return array( wp_validate_boolean( 'false' ), wp_validate_boolean( 'FALSE' ), wp_validate_boolean( 'true' ), wp_validate_boolean( 0 ), wp_validate_boolean( '1' ) );
