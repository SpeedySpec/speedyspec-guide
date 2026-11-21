<?php

declare(strict_types=1);

namespace Guide\Extractor;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use PhpParser\NodeVisitorAbstract;

/** Walks one file and records its symbols, calls, global use and hooks. */
final class Collector extends NodeVisitorAbstract {
	private const FILTERS       = array( 'apply_filters', 'apply_filters_ref_array', 'apply_filters_deprecated' );
	private const ACTIONS       = array( 'do_action', 'do_action_ref_array', 'do_action_deprecated' );
	private const REGISTRATIONS = array( 'add_filter' => 'filter', 'add_action' => 'action' );

	/** @var list<array{id: string, globals: array<string, true>}> */
	private array $scopes = array();
	/** @var list<string> */
	private array $classes = array();

	public function __construct(
		private readonly string $file,
		private readonly Inventory $inventory,
		private readonly bool $stubFile,
		private readonly Printer $printer,
		private readonly HookName $hookName,
		private readonly Hasher $hasher,
	) {}

	public function enterNode( Node $node ) {
		if ( $node instanceof Stmt\ClassLike && null !== $node->name ) {
			$name = $this->declaredName( $node );
			$this->classes[] = $name;
			$this->addSymbol( "class:{$name}", 'class', $name, $node, $this->classSignature( $node, $name ), $node, false, array() === $node->stmts );
			$this->scopes[] = array( 'id' => "class:{$name}", 'globals' => array() );
		} elseif ( $node instanceof Stmt\ClassMethod && $this->classes ) {
			$class = end( $this->classes );
			$id    = "method:{$class}::{$node->name->toString()}";
			$this->addSymbol( $id, 'method', $node->name->toString(), $node, $this->methodSignature( $node ), $node, false, empty( $node->stmts ) );
			$this->scopes[] = array( 'id' => $id, 'globals' => array() );
		} elseif ( $node instanceof Stmt\Function_ ) {
			$name = $this->declaredName( $node );
			$id   = "function:{$name}";
			$this->addSymbol( $id, 'function', $name, $node, $name . $this->params( $node ), $node, $this->insideFunctionExists( $node ), array() === $node->stmts );
			$this->scopes[] = array( 'id' => $id, 'globals' => array() );
		} elseif ( $node instanceof Stmt\Global_ ) {
			$this->globalStatement( $node );
		} elseif ( $node instanceof Stmt\Const_ && ! $this->classes ) {
			foreach ( $node->consts as $const ) {
				$this->addSymbol( "constant:{$const->name->toString()}", 'constant', $const->name->toString(), $const );
			}
		} elseif ( $node instanceof Expr\Assign || $node instanceof Expr\AssignRef || $node instanceof Expr\AssignOp ) {
			$this->write( $node->var );
		} elseif ( $node instanceof Expr\ArrayDimFetch ) {
			$this->globalsArray( $node );
		} elseif ( $node instanceof Expr\FuncCall ) {
			$this->funcCall( $node );
		} elseif ( $node instanceof Expr\StaticCall ) {
			$this->staticCall( $node );
		} elseif ( $node instanceof Expr\New_ ) {
			$this->newCall( $node );
		} elseif ( $node instanceof Expr\MethodCall || $node instanceof Expr\NullsafeMethodCall ) {
			$this->methodCall( $node );
		}
		return null;
	}

	public function leaveNode( Node $node ) {
		if ( $node instanceof Stmt\ClassLike && null !== $node->name ) {
			array_pop( $this->classes );
			array_pop( $this->scopes );
		} elseif ( ( $node instanceof Stmt\ClassMethod && $this->classes ) || $node instanceof Stmt\Function_ ) {
			array_pop( $this->scopes );
		}
		return null;
	}

	private function from(): string {
		$scope = end( $this->scopes );
		return false === $scope ? "file:{$this->file}" : $scope['id'];
	}

	private function addSymbol( string $id, string $kind, string $name, Node $at, ?string $signature = null, ?Node $hashed = null, bool $pluggable = false, ?bool $empty = null ): void {
		$symbol = array(
			'id'   => $id,
			'kind' => $kind,
			'name' => $name,
			'file' => $this->file,
			'line' => $at->getStartLine(),
		);
		if ( null !== $signature ) {
			$symbol['signature'] = $signature;
		}
		if ( $pluggable ) {
			$symbol['pluggable'] = true;
		}
		if ( null !== $hashed ) {
			$symbol['hash'] = $this->hasher->hash( $hashed );
		}
		if ( null === $empty ) {
			$this->inventory->addSymbol( $symbol );
		} else {
			$this->inventory->addDeclaration( $symbol, $this->stubFile ? 0 : ( $empty ? 1 : 2 ) );
		}
	}

	private function edge( string $to, string $kind, Node $at ): void {
		$this->inventory->addEdge( $this->from(), $to, $kind, $this->file, $at->getStartLine() );
	}

	private function unresolved( Expr $expr ): void {
		$this->inventory->addUnresolved( $this->from(), $this->printer->prettyPrintExpr( $expr ), $this->file, $expr->getStartLine() );
	}

	// Globals.

	private function globalStatement( Stmt\Global_ $node ): void {
		foreach ( $node->vars as $var ) {
			if ( $var instanceof Expr\Variable && is_string( $var->name ) ) {
				$this->useGlobal( $var->name, 'reads', $var );
				$last = array_key_last( $this->scopes );
				if ( null !== $last ) {
					$this->scopes[ $last ]['globals'][ $var->name ] = true;
				}
			}
		}
	}

	private function useGlobal( string $name, string $kind, Node $at ): void {
		$this->addSymbol( "global:{$name}", 'global', $name, $at );
		$this->edge( "global:{$name}", $kind, $at );
	}

	/** An assignment target: a global named in `global`, or `$GLOBALS['x']`, through any `[…]` or `->`. */
	private function write( Expr $target ): void {
		$globalsKey = $this->globalsKey( $target );
		if ( null !== $globalsKey ) {
			$this->useGlobal( $globalsKey, 'writes', $target );
			$this->markGlobalsFetch( $target );
			return;
		}
		$root = $target;
		while ( $root instanceof Expr\ArrayDimFetch || $root instanceof Expr\PropertyFetch ) {
			$root = $root->var;
		}
		$scope = end( $this->scopes );
		if ( $root instanceof Expr\Variable && is_string( $root->name ) && false !== $scope && isset( $scope['globals'][ $root->name ] ) ) {
			$this->useGlobal( $root->name, 'writes', $target );
		}
	}

	/** The key of the outermost `$GLOBALS['key']` in a target, or null. */
	private function globalsKey( Expr $expr ): ?string {
		while ( $expr instanceof Expr\ArrayDimFetch || $expr instanceof Expr\PropertyFetch ) {
			if ( $expr instanceof Expr\ArrayDimFetch && $expr->var instanceof Expr\Variable && 'GLOBALS' === $expr->var->name ) {
				return $expr->dim instanceof Node\Scalar\String_ ? $expr->dim->value : null;
			}
			$expr = $expr->var;
		}
		return null;
	}

	private function markGlobalsFetch( Expr $expr ): void {
		while ( $expr instanceof Expr\ArrayDimFetch || $expr instanceof Expr\PropertyFetch ) {
			$expr->setAttribute( 'guideWritten', true );
			$expr = $expr->var;
		}
	}

	private function globalsArray( Expr\ArrayDimFetch $node ): void {
		if ( $node->getAttribute( 'guideWritten' ) ) {
			return;
		}
		if ( $node->var instanceof Expr\Variable && 'GLOBALS' === $node->var->name && $node->dim instanceof Node\Scalar\String_ ) {
			$this->useGlobal( $node->dim->value, 'reads', $node );
		}
	}

	// Calls.

	private function funcCall( Expr\FuncCall $node ): void {
		if ( ! $node->name instanceof Name ) {
			$this->unresolved( $node );
			return;
		}
		$name  = ltrim( $node->name->toString(), '\\' );
		$lower = strtolower( $name );
		$this->edge( "function:{$name}", 'calls', $node );

		$args = $node->getArgs();
		if ( in_array( $lower, self::FILTERS, true ) || in_array( $lower, self::ACTIONS, true ) ) {
			if ( isset( $args[0] ) ) {
				$this->fires( in_array( $lower, self::FILTERS, true ) ? 'filter' : 'action', $args[0]->value, $node );
			}
		} elseif ( isset( self::REGISTRATIONS[ $lower ] ) ) {
			if ( isset( $args[0], $args[1] ) ) {
				$this->registers( self::REGISTRATIONS[ $lower ], $args[0]->value, $args[1]->value, $node );
			}
		} elseif ( 'call_user_func' === $lower || 'call_user_func_array' === $lower ) {
			$target = isset( $args[0] ) ? $this->callable( $args[0]->value ) : null;
			if ( null === $target ) {
				$this->unresolved( $node );
			} else {
				$this->edge( $target, 'calls', $node );
			}
		} elseif ( 'define' === $lower && isset( $args[0] ) && $args[0]->value instanceof Node\Scalar\String_ ) {
			$this->addSymbol( "constant:{$args[0]->value->value}", 'constant', $args[0]->value->value, $node );
		}
	}

	private function staticCall( Expr\StaticCall $node ): void {
		$class = $node->class instanceof Name ? $this->className( $node->class ) : null;
		if ( null === $class || ! $node->name instanceof Node\Identifier ) {
			$this->unresolved( $node );
			return;
		}
		$this->edge( "method:{$class}::{$node->name->toString()}", 'calls', $node );
	}

	private function newCall( Expr\New_ $node ): void {
		if ( $node->class instanceof Stmt\Class_ ) {
			return;
		}
		$class = $node->class instanceof Name ? $this->className( $node->class ) : null;
		if ( null === $class ) {
			$this->unresolved( $node );
			return;
		}
		$this->edge( "class:{$class}", 'calls', $node );
	}

	/** Only `$this->m()` resolves; another receiver's type is unknown and is not reported. */
	private function methodCall( Expr\MethodCall|Expr\NullsafeMethodCall $node ): void {
		if ( ! $node->name instanceof Node\Identifier ) {
			$this->unresolved( $node );
			return;
		}
		if ( $node->var instanceof Expr\Variable && 'this' === $node->var->name && $this->classes ) {
			$this->edge( 'method:' . end( $this->classes ) . "::{$node->name->toString()}", 'calls', $node );
		}
	}

	// Hooks.

	private function fires( string $kind, Expr $nameExpr, Node $at ): void {
		$hook = $this->hookName->from( $nameExpr );
		if ( null === $hook ) {
			$this->unresolved( $nameExpr );
			return;
		}
		$id = "{$kind}:{$hook['name']}";
		$this->addHook( $id, $kind, $hook, $at );
		$this->edge( $id, 'fires', $at );
	}

	private function registers( string $kind, Expr $nameExpr, Expr $callback, Node $at ): void {
		$hook = $this->hookName->from( $nameExpr );
		if ( null === $hook || $hook['dynamic'] ) {
			return;
		}
		$target = $this->callable( $callback );
		if ( null === $target ) {
			return;
		}
		$id = "{$kind}:{$hook['name']}";
		$this->addHook( $id, $kind, $hook, $at );
		$this->inventory->addEdge( $id, $target, 'runs', $this->file, $at->getStartLine() );
	}

	/** @param array{name: string, dynamic: bool} $hook */
	private function addHook( string $id, string $kind, array $hook, Node $at ): void {
		if ( $this->inventory->has( $id ) ) {
			return;
		}
		$symbol = array(
			'id'   => $id,
			'kind' => $kind,
			'name' => $hook['name'],
			'file' => $this->file,
			'line' => $at->getStartLine(),
		);
		if ( $hook['dynamic'] ) {
			$symbol['dynamic'] = true;
		}
		$this->inventory->addSymbol( $symbol );
	}

	/** A callback that names its target in code: `'fn'`, `'Class::m'`, `array( 'Class', 'm' )`. */
	private function callable( Expr $expr ): ?string {
		if ( $expr instanceof Node\Scalar\String_ ) {
			$value = ltrim( $expr->value, '\\' );
			if ( str_contains( $value, '::' ) ) {
				[ $class, $method ] = explode( '::', $value, 2 );
				return "method:{$class}::{$method}";
			}
			return '' === $value ? null : "function:{$value}";
		}
		if ( $expr instanceof Expr\Array_ && 2 === count( $expr->items ) ) {
			[ $first, $second ] = $expr->items;
			if ( null !== $first && null !== $second && $first->value instanceof Node\Scalar\String_ && $second->value instanceof Node\Scalar\String_ ) {
				return 'method:' . ltrim( $first->value->value, '\\' ) . "::{$second->value->value}";
			}
		}
		return null;
	}

	// Names and signatures.

	private function declaredName( Stmt\ClassLike|Stmt\Function_ $node ): string {
		$namespaced = $node->getAttribute( 'namespacedName' );
		return $namespaced instanceof Name ? $namespaced->toString() : (string) $node->name;
	}

	private function className( Name $name ): ?string {
		$lower = $name->toLowerString();
		if ( 'self' === $lower || 'static' === $lower ) {
			return $this->classes ? end( $this->classes ) : null;
		}
		if ( 'parent' === $lower ) {
			return null;
		}
		$resolved = $name->getAttribute( 'resolvedName' );
		return ltrim( ( $resolved instanceof Name ? $resolved : $name )->toString(), '\\' );
	}

	private function insideFunctionExists( Node $node ): bool {
		for ( $parent = $node->getAttribute( 'parent' ); null !== $parent; $parent = $parent->getAttribute( 'parent' ) ) {
			if ( $parent instanceof Stmt\If_ && $this->mentionsFunctionExists( $parent->cond ) ) {
				return true;
			}
		}
		return false;
	}

	private function mentionsFunctionExists( Node $expr ): bool {
		$finder = new \PhpParser\NodeFinder();
		return null !== $finder->findFirst(
			$expr,
			static fn( Node $n ) => $n instanceof Expr\FuncCall && $n->name instanceof Name && 'function_exists' === $n->name->toLowerString()
		);
	}

	private function params( Node\FunctionLike $node ): string {
		$params = array_map( fn( Node\Param $p ) => $this->printer->node( $p ), $node->getParams() );
		$return = $node->getReturnType();
		return '(' . implode( ', ', $params ) . ')' . ( null === $return ? '' : ': ' . $this->printer->node( $return ) );
	}

	private function methodSignature( Stmt\ClassMethod $node ): string {
		$mods = array();
		$mods[] = $node->isPrivate() ? 'private' : ( $node->isProtected() ? 'protected' : 'public' );
		if ( $node->isAbstract() ) {
			$mods[] = 'abstract';
		}
		if ( $node->isFinal() ) {
			$mods[] = 'final';
		}
		if ( $node->isStatic() ) {
			$mods[] = 'static';
		}
		return implode( ' ', $mods ) . ' ' . $node->name->toString() . $this->params( $node );
	}

	private function classSignature( Stmt\ClassLike $node, string $name ): string {
		$names = static fn( array $list ) => implode( ', ', array_map( static fn( Name $n ) => $n->toString(), $list ) );
		if ( $node instanceof Stmt\Interface_ ) {
			return "interface {$name}" . ( $node->extends ? ' extends ' . $names( $node->extends ) : '' );
		}
		if ( $node instanceof Stmt\Trait_ ) {
			return "trait {$name}";
		}
		if ( $node instanceof Stmt\Enum_ ) {
			return "enum {$name}" . ( $node->implements ? ' implements ' . $names( $node->implements ) : '' );
		}
		/** @var Stmt\Class_ $node */
		$mods = array();
		if ( $node->isAbstract() ) {
			$mods[] = 'abstract';
		}
		if ( $node->isFinal() ) {
			$mods[] = 'final';
		}
		if ( $node->isReadonly() ) {
			$mods[] = 'readonly';
		}
		$mods[] = "class {$name}";
		return implode( ' ', $mods )
			. ( $node->extends ? " extends {$node->extends->toString()}" : '' )
			. ( $node->implements ? ' implements ' . $names( $node->implements ) : '' );
	}
}
