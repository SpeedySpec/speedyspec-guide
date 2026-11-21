<?php

declare(strict_types=1);

namespace Guide\Extractor;

use PhpParser\Node;
use PhpParser\PrettyPrinter\Standard;

/** The standard pretty printer, able to print any single node. */
final class Printer extends Standard {
	public function node( Node $node ): string {
		$this->resetState();
		return $this->p( $node );
	}
}
