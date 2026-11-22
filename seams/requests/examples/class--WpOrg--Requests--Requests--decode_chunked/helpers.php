<?php
// The static helpers: decode_chunked(), flatten() for header lines, decompress() and compatible_gzinflate().
use WpOrg\Requests\Requests;
// decode_chunked() is protected; parse_response() uses it.
$decode = Closure::bind( fn( $d ) => self::decode_chunked( $d ), null, Requests::class );
return array( $decode( "3\r\nabc\r\n2\r\nde\r\n0\r\n\r\n" ), $decode( 'not chunked' ), Requests::flatten( array( 'A' => '1', 'B' => '2' ) ), Requests::decompress( gzcompress( 'z' ) ), Requests::compatible_gzinflate( gzdeflate( 'raw' ) ), Requests::decompress( 'plain' ) );
