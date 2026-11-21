<?php

declare(strict_types=1);

namespace Guide\Extractor;

use PhpParser\Error;
use PhpParser\ErrorHandler\Collecting;
use PhpParser\PhpVersion;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\Parser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\NodeVisitor\ParentConnectingVisitor;
use PhpParser\ParserFactory;

/** Parses every PHP file under a root and collects its inventory. */
final class Extractor {
	/** @param list<string> $stubs Files whose declarations are stubs. */
	private readonly Parser $newest;
	private readonly Parser $legacy;

	public function __construct( private readonly string $base, private readonly array $stubs = array() ) {
		$factory      = new ParserFactory();
		$this->newest = $factory->createForNewestSupportedVersion();
		$this->legacy = $factory->createForVersion( PhpVersion::fromString( '7.0' ) );
	}

	/** @return array<string, mixed> */
	public function extract( string $root ): array {
		$printer   = new Printer();
		$inventory = new Inventory( $this->base );

		foreach ( $this->files( $root ) as $relative ) {
			$code = file_get_contents( $root . '/' . $relative );
			if ( false === $code ) {
				fwrite( STDERR, "unreadable: {$relative}\n" );
				continue;
			}
			$ast = $this->parse( $code );
			if ( is_string( $ast ) ) {
				$inventory->addError( $relative, $ast );
				fwrite( STDERR, "parse error in {$relative}: {$ast}\n" );
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

	/**
	 * Parses with the newest grammar first. Older WordPress code (`$s{0}`, `=& new`) fails there, so it is parsed again with the
	 * PHP 7.0 grammar, keeping recoverable errors. A file that still yields broken nodes is reported, not guessed at.
	 *
	 * @return array<\PhpParser\Node>|string The syntax tree, or the parse errors.
	 */
	private function parse( string $code ): array|string {
		try {
			return $this->newest->parse( $code ) ?? array();
		} catch ( Error $e ) {
			$first = $e->getMessage();
		}
		$errors = new Collecting();
		$ast    = $this->legacy->parse( $code, $errors );
		if ( null !== $ast && null === ( new NodeFinder() )->findFirstInstanceOf( $ast, \PhpParser\Node\Expr\Error::class ) ) {
			return $ast;
		}
		$messages = array_map( static fn( Error $e ) => $e->getMessage(), $errors->getErrors() );
		return implode( '; ', $messages ?: array( $first ) );
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
