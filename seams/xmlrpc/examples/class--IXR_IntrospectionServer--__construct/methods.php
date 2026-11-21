<?php
// The introspection server adds system.methodSignature and system.methodHelp, with signatures and help for every method, and the introspection capability.
$server = new IXR_IntrospectionServer();
return array( array_keys( $server->callbacks ), $server->signatures['system.methodHelp'], array_keys( $server->capabilities ) );
