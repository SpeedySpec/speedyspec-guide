<?php
// A methodCall with each argument as a param value; getLength() is its length in bytes.
$request = new IXR_Request( 'demo.add', array( 2, 'x' ) );
return array( $request->getXml(), $request->getLength() );
