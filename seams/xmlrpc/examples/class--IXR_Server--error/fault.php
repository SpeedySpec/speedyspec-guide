<?php
// Prints a fault, from an IXR_Error or a code and message, and exits.
$server = new IXR_Server( array(), false, true );
$server->error( -32601, 'no such method' );
return 'not reached';
