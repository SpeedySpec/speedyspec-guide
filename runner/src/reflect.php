/**
 * Lists every declared function, class, interface, trait, enum, public or protected method, and constant, with
 * signatures in the guide extractor's format, as JSON.
 */
function speedyspec_guide_reflect(): string {
	$out = array();
	$sym = static function ( string $kind, string $id, string $name, ?string $signature ) use ( &$out ): void {
		$entry = array( 'id' => $id, 'kind' => $kind, 'name' => $name, 'file' => 'native', 'line' => 0 );
		if ( null !== $signature ) {
			$entry['signature'] = $signature;
		}
		$out[] = $entry;
	};

	$functions = get_defined_functions();
	foreach ( array_merge( $functions['internal'], $functions['user'] ) as $name ) {
		$f = new \ReflectionFunction( $name );
		$sym( 'function', 'function:' . $f->getName(), $f->getName(), $f->getName() . speedyspec_guide_params( $f ) );
	}

	foreach ( array_merge( get_declared_classes(), get_declared_interfaces(), get_declared_traits() ) as $name ) {
		$c = new \ReflectionClass( $name );
		if ( $c->isAnonymous() ) {
			continue;
		}
		$class = $c->getName();
		$sym( 'class', 'class:' . $class, $class, speedyspec_guide_class_signature( $c ) );
		foreach ( $c->getMethods() as $m ) {
			if ( $m->getDeclaringClass()->getName() !== $class || $m->isPrivate() ) {
				continue;
			}
			$mods = array( $m->isProtected() ? 'protected' : 'public' );
			if ( $m->isAbstract() && ! $c->isInterface() ) {
				$mods[] = 'abstract';
			}
			if ( $m->isFinal() ) {
				$mods[] = 'final';
			}
			if ( $m->isStatic() ) {
				$mods[] = 'static';
			}
			$sym( 'method', "method:{$class}::{$m->getName()}", $m->getName(), implode( ' ', $mods ) . ' ' . $m->getName() . speedyspec_guide_params( $m ) );
		}
	}

	foreach ( array_keys( get_defined_constants() ) as $name ) {
		$sym( 'constant', 'constant:' . $name, $name, null );
	}

	return json_encode( $out, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE | JSON_THROW_ON_ERROR );
}

/** `($a, int $b = 10, ...$rest): type`, with defaults as PHP writes them in the parameter's string form. */
function speedyspec_guide_params( \ReflectionFunctionAbstract $f ): string {
	$params = array();
	foreach ( $f->getParameters() as $p ) {
		$text = '';
		if ( $p->hasType() ) {
			$text .= (string) $p->getType() . ' ';
		}
		if ( $p->isPassedByReference() ) {
			$text .= '&';
		}
		if ( $p->isVariadic() ) {
			$text .= '...';
		}
		$text .= '$' . $p->getName();
		if ( $p->isOptional() && ! $p->isVariadic() && preg_match( '/ = (.*) \]$/s', (string) $p, $m ) ) {
			$text .= ' = ' . $m[1];
		}
		$params[] = $text;
	}
	$return = null;
	if ( $f->hasReturnType() ) {
		$return = (string) $f->getReturnType();
	} elseif ( $f->hasTentativeReturnType() ) {
		$return = (string) $f->getTentativeReturnType();
	}
	return '(' . implode( ', ', $params ) . ')' . ( null === $return ? '' : ': ' . $return );
}

function speedyspec_guide_class_signature( \ReflectionClass $c ): string {
	if ( $c->isInterface() ) {
		$parents = $c->getInterfaceNames();
		return 'interface ' . $c->getName() . ( $parents ? ' extends ' . implode( ', ', $parents ) : '' );
	}
	if ( $c->isTrait() ) {
		return 'trait ' . $c->getName();
	}
	if ( $c->isEnum() ) {
		return 'enum ' . $c->getName();
	}
	$mods = array();
	if ( $c->isAbstract() ) {
		$mods[] = 'abstract';
	}
	if ( $c->isFinal() ) {
		$mods[] = 'final';
	}
	if ( $c->isReadOnly() ) {
		$mods[] = 'readonly';
	}
	$mods[]     = 'class ' . $c->getName();
	$parent     = $c->getParentClass();
	$interfaces = $c->getInterfaceNames();
	return implode( ' ', $mods )
		. ( $parent ? ' extends ' . $parent->getName() : '' )
		. ( $interfaces ? ' implements ' . implode( ', ', $interfaces ) : '' );
}
