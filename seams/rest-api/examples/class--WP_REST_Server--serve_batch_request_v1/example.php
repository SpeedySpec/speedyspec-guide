<?php
// Serves POST /batch/v1: up to the maximum batch size of requests, each routed to its handler and answered in order; require-all-validate refuses them all if one is invalid.
$data = guide_rest( 'POST', '/batch/v1', array( 'requests' => array(
	array( 'method' => 'POST', 'path' => '/wp/v2/posts', 'body' => array( 'title' => 'One', 'status' => 'publish' ) ),
	array( 'method' => 'POST', 'path' => '/wp/v2/posts', 'body' => array( 'title' => 'Two', 'status' => 'publish' ) ),
) ) )[1];
return array_map( fn( $r ) => array( $r['status'], $r['body']['title']['raw'] ), $data['responses'] );
