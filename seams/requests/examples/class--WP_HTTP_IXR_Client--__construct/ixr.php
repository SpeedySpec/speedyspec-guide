<?php
// An XML-RPC client over the HTTP API: query() posts the request with wp_safe_remote_post() (wp_http_ixr_client_headers filters the headers) and parses the response.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/xml\r\n\r\n<?xml version=\"1.0\"?><methodResponse><params><param><value><int>5</int></value></param></params></methodResponse>" );
function guide_add_ixr_header( $headers ) {
	return $headers + array( 'X-Guide' => '1' );
}
add_filter( 'wp_http_ixr_client_headers', 'guide_add_ixr_header' );
$client = new WP_HTTP_IXR_Client( 'http://example.org/xmlrpc.php' );
$ok = $client->query( 'demo.add', 2, 3 );
return array( $ok, $client->getResponse(), $client->server, $client->path, Guide_Queue_Transport::$sent[0]['headers']['X-Guide'], Guide_Queue_Transport::$sent[0]['method'] );
