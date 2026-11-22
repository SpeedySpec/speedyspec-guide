<?php
// Protected helpers: minimum_args() and _is_fields_array() set a 400 fault when the arguments fall short; _convert_date() turns a MySQL date into an IXR_Date.
add_filter( 'pre_option_timezone_string', fn() => 'UTC' );
add_filter( 'pre_option_gmt_offset', fn() => '0' );
$server = new wp_xmlrpc_server();
return Closure::bind( function () {
	return array( $this->minimum_args( array( 1, 2 ), 3 ), $this->error->message, $this->_is_fields_array( 'x' ), $this->error->message, $this->_convert_date( '2026-01-02 03:04:05' )->getIso(), $this->_convert_date( '0000-00-00 00:00:00' )->getIso(), $this->_is_greater_than_one( 2 ) );
}, $server, wp_xmlrpc_server::class )();
