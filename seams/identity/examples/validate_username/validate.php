<?php
// Whether a login is valid: unchanged by sanitize_user() in strict mode; validate_username filters it.
return array( validate_username( 'ada' ), validate_username( 'Ada Lovelace' ), validate_username( 'ada!' ), validate_username( '' ) );
