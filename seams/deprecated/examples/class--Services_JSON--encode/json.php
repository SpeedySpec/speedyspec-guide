<?php
// Services_JSON, the old pure-PHP JSON library, kept for code that loads it: including its file reports it deprecated since 5.3.0 (use the native json_encode() and json_decode()). encode() turns values into JSON, decode() reads it back (as objects, or arrays with SERVICES_JSON_LOOSE_TYPE).
add_action( 'deprecated_file_included', fn( $file, $replacement, $version ) => print( "deprecated_file_included $file $version\n" ), 10, 3 );
require_once ABSPATH . WPINC . '/class-json.php';
$json = new Services_JSON();
$loose = new Services_JSON( SERVICES_JSON_LOOSE_TYPE );
return array( $json->encode( array( 'a' => 1, 'b' => array( true, null, 'x"y' ) ) ), $json->decode( '{"a":1,"b":[true,null]}' ), $loose->decode( '{"a":1}' ), $json->encode( 'é' ) );
