<?php
// Encodes a value as JSON, with invalid UTF-8 fixed and the options and depth given; false when it can't be encoded.
return array( wp_json_encode( array( 'a' => 'é', 'b' => array( 1, 2 ) ) ), wp_json_encode( array( 'x' => 1 ), JSON_PRETTY_PRINT ), wp_json_encode( "bad \xB1 utf8" ) );
