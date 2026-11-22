<?php
// The message is parsed in chunks of xmlrpc_chunk_parsing_size bytes (256 KB by default).
function guide_chunk_parsing_size( $size ) {
	return 16;
}
add_filter( 'xmlrpc_chunk_parsing_size', 'guide_chunk_parsing_size' );
$message = new IXR_Message( '<methodCall><methodName>demo.echo</methodName><params><param><value><string>a long enough string</string></value></param></params></methodCall>' );
return array( $message->parse(), $message->params );
