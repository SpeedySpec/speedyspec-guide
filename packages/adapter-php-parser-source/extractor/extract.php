<?php
/**
 * Usage: php extract.php <root> <base> <version>
 *
 * Prints the inventory of every PHP file under <root> as JSON: symbols, edges and unresolved calls.
 * Reads code only, never comments.
 */

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Guide\Extractor\Extractor;

if ( $argc !== 4 || ! in_array( $argv[2], array( 'wp', 'ss' ), true ) ) {
	fwrite( STDERR, "usage: php extract.php <root> <wp|ss> <version>\n" );
	exit( 2 );
}
$root = rtrim( $argv[1], '/' );
if ( ! is_dir( $root ) ) {
	fwrite( STDERR, "not a directory: {$root}\n" );
	exit( 2 );
}

$inventory = ( new Extractor( $argv[2] ) )->extract( $root );
$inventory['version'] = $argv[3];
echo json_encode( $inventory, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR ), "\n";
