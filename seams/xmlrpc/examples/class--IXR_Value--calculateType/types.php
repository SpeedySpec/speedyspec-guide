<?php
// The XML-RPC type of a PHP value: boolean, int, double, date, base64, string, array for a list, struct for keyed arrays and objects.
$values = array( true, 3, 1.5, 'x', array( 1, 2 ), array( 'a' => 1 ), array( 1 => 'x' ), (object) array( 'p' => 1 ), new IXR_Date( 0 ), new IXR_Base64( 'b' ) );
return array_map( fn( $v ) => ( new IXR_Value( $v ) )->type, $values );
