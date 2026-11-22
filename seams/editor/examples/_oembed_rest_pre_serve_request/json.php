<?php
// Serves the oEmbed endpoint as XML when format=xml is asked for; any other request is left to the REST server.
$server = new WP_REST_Server();
$request = new WP_REST_Request( 'GET', '/oembed/1.0/embed' );
$request->set_param( 'format', 'xml' );
$other = new WP_REST_Request( 'GET', '/wp/v2/posts' );
$xml = guide_render( fn() => _oembed_rest_pre_serve_request( false, new WP_REST_Response( array( 'version' => '1.0' ) ), $request, $server ) );
return array( _oembed_rest_pre_serve_request( false, null, $other, $server ), $xml );
