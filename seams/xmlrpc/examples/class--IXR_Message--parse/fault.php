<?php
// A fault response sets faultCode and faultString.
$message = new IXR_Message( '<methodResponse><fault><value><struct><member><name>faultCode</name><value><int>4</int></value></member><member><name>faultString</name><value><string>Too many</string></value></member></struct></value></fault></methodResponse>' );
$message->parse();
return array( $message->messageType, $message->faultCode, $message->faultString );
