<?php
// Whether a string is a UUID, of a version when asked (only 4 is checked).
return array( wp_is_uuid( '123e4567-e89b-42d3-a456-426614174000', 4 ), wp_is_uuid( '123e4567-e89b-12d3-a456-426614174000' ), wp_is_uuid( 'nope' ) );
