<?php
// The old transports, kept for code that uses them directly: each tests whether it can work (use_curl_transport and use_streams_transport can veto); WP_HTTP_Fsockopen is the streams transport's old name.
add_filter( 'use_curl_transport', fn( $use ) => $use, 10, 2 );
add_filter( 'use_streams_transport', fn( $use ) => $use, 10, 2 );
return array( is_bool( WP_Http_Curl::test() ), WP_Http_Streams::test(), WP_Http_Streams::test( array( 'ssl' => true ) ), get_parent_class( new WP_HTTP_Fsockopen() ) );
