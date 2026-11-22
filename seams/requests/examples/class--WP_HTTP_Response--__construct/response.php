<?php
// A response holding data, a status and headers, set and read through methods; jsonSerialize() gives the data.
$r = new WP_HTTP_Response( array( 'ok' => true ), 201, array( 'X-A' => '1' ) );
$r->header( 'X-B', '2' );
$r->header( 'X-A', '3', false );
$r->set_status( 202 );
$r->set_data( 'changed' );
return array( $r->get_status(), $r->get_headers(), $r->get_data(), $r->jsonSerialize() );
