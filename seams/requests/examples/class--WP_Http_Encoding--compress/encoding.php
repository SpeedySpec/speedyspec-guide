<?php
// Compression helpers: compress() deflates, decompress() handles gzip, zlib and deflate, accept_encoding() and content_encoding() give the headers, should_decode() reads a Content-Encoding.
function guide_keep_accept_encoding( $types ) {
	return $types;
}
add_filter( 'wp_http_accept_encoding', 'guide_keep_accept_encoding' );
$z = WP_Http_Encoding::compress( 'text' );
return array( WP_Http_Encoding::decompress( $z ), WP_Http_Encoding::decompress( gzencode( 'gz' ) ), WP_Http_Encoding::compatible_gzinflate( gzcompress( 'zlib' ) ), WP_Http_Encoding::accept_encoding( 'http://example.org/', array( 'decompress' => true, 'stream' => false ) ), WP_Http_Encoding::accept_encoding( 'http://example.org/', array( 'decompress' => false ) ), WP_Http_Encoding::content_encoding(), WP_Http_Encoding::should_decode( array( 'content-encoding' => 'gzip' ) ), WP_Http_Encoding::should_decode( 'Content-Type: text/html' ), WP_Http_Encoding::is_available() );
