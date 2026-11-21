<?php

declare(strict_types=1);

namespace Guide\Extractor;

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;

/** Hashes a node's code with comments and formatting removed, so only a change in code changes the hash. It clears the node's comments in place: the extractor never prints comments. */
final class Hasher {
	public function __construct( private readonly Printer $printer ) {}

	public function hash( Node $node ): string {
		$traverser = new NodeTraverser( new class() extends NodeVisitorAbstract {
			public function enterNode( Node $node ) {
				$node->setAttribute( 'comments', array() );
				return null;
			}
		} );
		$traverser->traverse( array( $node ) );
		return hash( 'sha256', $this->printer->prettyPrint( array( $node ) ) );
	}
}
