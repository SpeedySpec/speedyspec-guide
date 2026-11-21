<?php
// Adds # to a valid color; anything else is returned as it is.
return array( maybe_hash_hex_color( 'abc' ), maybe_hash_hex_color( '#abc' ), maybe_hash_hex_color( 'red' ) );
