<?php
// The message is parsed in chunks of xmlrpc_chunk_parsing_size bytes (256 KB by default).
add_filter( 'xmlrpc_chunk_parsing_size', fn() => 16 );
$message = new IXR_Message( '<methodCall><methodName>demo.echo</methodName><params><param><value><string>a long enough string</string></value></param></params></methodCall>' );
return array( $message->parse(), $message->params );
