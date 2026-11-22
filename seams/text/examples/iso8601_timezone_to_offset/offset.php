<?php
// Turns an ISO 8601 time zone into an offset in seconds, a float for an offset like +0530.
return array( iso8601_timezone_to_offset( '+0530' ), iso8601_timezone_to_offset( 'Z' ) );
