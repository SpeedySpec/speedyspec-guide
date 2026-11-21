<?php

declare(strict_types=1);

namespace Guide\Extractor;

use PhpParser\Error;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\NodeVisitor\ParentConnectingVisitor;
use PhpParser\ParserFactory;

/** Parses every PHP file under a root and collects its inventory. */
final class Extractor {
	/** @param list<string> $stubs Files whose declarations are stubs. */
	public function __construct( private readonly string $base, private readonly array $stubs = array() ) {}

	/** @return array<string, mixed> */
	public function extract( string $root ): array {
		$parser    = ( new ParserFactory() )->createForNewestSupportedVersion();
		$printer   = new Printer();
		$inventory = new Inventory( $this->base );

		foreach ( $this->files( $root ) as $relative ) {
			$code = file_get_contents( $root . '/' . $relative );
			if ( false === $code ) {
				fwrite( STDERR, "unreadable: {$relative}\n" );
				continue;
			}
			try {
				$ast = $parser->parse( $code ) ?? array();
			} catch ( Error $e ) {
				fwrite( STDERR, "parse error in {$relative}: {$e->getMessage()}\n" );
				continue;
			}
			$traverser = new NodeTraverser(
				new NameResolver( null, array( 'replaceNodes' => false ) ),
				new ParentConnectingVisitor(),
				new Collector( $relative, $inventory, in_array( $relative, $this->stubs, true ), $printer, new HookName( $printer ), new Hasher( $printer ) )
			);
			$traverser->traverse( $ast );
		}
		return $inventory->toArray();
	}

	/** @return list<string> Paths relative to the root, sorted. */
	private function files( string $root ): array {
		$out = array();
		$it  = new \RecursiveIteratorIterator( new \RecursiveDirectoryIterator( $root, \FilesystemIterator::SKIP_DOTS ) );
		foreach ( $it as $file ) {
			if ( $file->isFile() && 'php' === strtolower( $file->getExtension() ) ) {
				$out[] = substr( $file->getPathname(), strlen( $root ) + 1 );
			}
		}
		sort( $out, SORT_STRING );
		return $out;
	}
}
