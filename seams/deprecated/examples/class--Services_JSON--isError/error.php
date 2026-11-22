<?php
// isError() says whether a value is a Services_JSON_Error (or a PEAR_Error), which encode() gives for a value it can't encode.
require_once ABSPATH . WPINC . '/class-json.php';
$json = new Services_JSON();
$error = new Services_JSON_Error( 'bad' );
return array( $json->isError( $error ), $json->isError( 'fine' ), get_class( $error ) );
