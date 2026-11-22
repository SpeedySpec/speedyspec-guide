<?php
// The REST server, made once (its class filtered by wp_rest_server_class) and kept in $wp_rest_server; making it fires rest_api_init.
$fired = did_action( 'rest_api_init' );
$server = rest_get_server();
return array( $fired, did_action( 'rest_api_init' ), get_class( $server ), $server === rest_get_server() );
