<?php
// The value as XML-RPC: strings are escaped, and arrays and structs nest their values.
$value = new IXR_Value( array( 'title' => 'A & B', 'tags' => array( 'x', 2 ), 'ok' => false ) );
return $value->getXml();
