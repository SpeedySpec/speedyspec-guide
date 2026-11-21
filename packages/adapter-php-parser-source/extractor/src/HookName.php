<?php

declare(strict_types=1);

namespace Guide\Extractor;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\BinaryOp\Concat;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\InterpolatedStringPart;
use PhpParser\Node\Scalar\InterpolatedString;
use PhpParser\Node\Scalar\String_;

/** Turns a hook-name expression into a literal name, a `{$…}` template, or nothing. */
final class HookName {
	public function __construct( private readonly Printer $printer ) {}

	/**
	 * @return array{name: string, dynamic: bool}|null Null when the name can't be written as a template.
	 */
	public function from( Expr $expr ): ?array {
		$parts = $this->parts( $expr );
		if ( null === $parts ) {
			return null;
		}
		$dynamic = false;
		$name    = '';
		foreach ( $parts as $part ) {
			if ( is_string( $part ) ) {
				$name .= $part;
			} else {
				$dynamic = true;
				$name   .= '{' . $this->printer->prettyPrintExpr( $part ) . '}';
			}
		}
		return array( 'name' => $name, 'dynamic' => $dynamic );
	}

	/** @return list<string|Expr>|null */
	private function parts( Expr $expr ): ?array {
		if ( $expr instanceof String_ ) {
			return array( $expr->value );
		}
		if ( $expr instanceof InterpolatedString ) {
			$out = array();
			foreach ( $expr->parts as $part ) {
				if ( $part instanceof InterpolatedStringPart ) {
					$out[] = $part->value;
				} elseif ( $this->isVariablePart( $part ) ) {
					$out[] = $part;
				} else {
					return null;
				}
			}
			return $out;
		}
		if ( $expr instanceof Concat ) {
			$left  = $this->parts( $expr->left );
			$right = $this->parts( $expr->right );
			return null === $left || null === $right ? null : array_merge( $left, $right );
		}
		if ( $this->isVariablePart( $expr ) ) {
			return array( $expr );
		}
		return null;
	}

	private function isVariablePart( Expr $expr ): bool {
		if ( $expr instanceof Variable ) {
			return is_string( $expr->name );
		}
		if ( $expr instanceof ArrayDimFetch ) {
			return $this->isVariablePart( $expr->var ) && ( null === $expr->dim || $expr->dim instanceof \PhpParser\Node\Scalar );
		}
		if ( $expr instanceof PropertyFetch ) {
			return $this->isVariablePart( $expr->var ) && $expr->name instanceof \PhpParser\Node\Identifier;
		}
		return false;
	}
}
