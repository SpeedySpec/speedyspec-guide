<?php
// The same check, for a color with or without #, returned without it.
return array( sanitize_hex_color_no_hash( '#abc' ), sanitize_hex_color_no_hash( 'a1b2c3' ), sanitize_hex_color_no_hash( 'xyz' ), sanitize_hex_color_no_hash( '#' ) );
