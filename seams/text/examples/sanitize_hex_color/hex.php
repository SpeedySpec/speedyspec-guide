<?php
// A 3- or 6-digit color with #, or '' for '', or null.
return array( sanitize_hex_color( '#ABC' ), sanitize_hex_color( '#a1b2c3' ), sanitize_hex_color( 'abc' ), sanitize_hex_color( '' ), sanitize_hex_color( '#abcd' ) );
