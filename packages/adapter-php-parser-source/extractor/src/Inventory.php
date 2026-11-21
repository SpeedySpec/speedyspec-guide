<?php

declare(strict_types=1);

namespace Guide\Extractor;

/** Collects symbols, edges and unresolved calls; each symbol and each (from, to, kind) edge is kept once. */
final class Inventory {
	/** @var array<string, array<string, mixed>> */
	private array $symbols = array();
	/** @var array<string, int> The rank of the kept declaration of each id. */
	private array $rank = array();
	/** @var array<string, array<string, mixed>> */
	private array $edges = array();
	/** @var list<array<string, mixed>> */
	private array $unresolved = array();

	public function __construct( private readonly string $base ) {}

	public function has( string $id ): bool {
		return isset( $this->symbols[ $id ] );
	}

	/**
	 * A function, class or method declaration, ranked 0 (in a stub file), 1 (empty body) or 2 (real). When the same id
	 * is declared again, a higher rank replaces the kept one; otherwise the first stays. The others are kept as `alternates`.
	 *
	 * @param array<string, mixed> $symbol
	 */
	public function addDeclaration( array $symbol, int $rank ): void {
		$id = $symbol['id'];
		if ( ! isset( $this->symbols[ $id ] ) ) {
			$this->symbols[ $id ] = $symbol;
			$this->rank[ $id ]    = $rank;
			return;
		}
		$kept       = $this->symbols[ $id ];
		$alternates = $kept['alternates'] ?? array();
		$pluggable  = ! empty( $kept['pluggable'] ) || ! empty( $symbol['pluggable'] );
		if ( $rank > $this->rank[ $id ] ) {
			$alternates[]          = "{$kept['file']}:{$kept['line']}";
			$kept                  = $symbol;
			$this->rank[ $id ]   = $rank;
		} else {
			$alternates[] = "{$symbol['file']}:{$symbol['line']}";
		}
		$kept['alternates'] = $alternates;
		if ( $pluggable ) {
			$kept['pluggable'] = true;
		}
		$this->symbols[ $id ] = $kept;
	}

	/** @param array<string, mixed> $symbol */
	public function addSymbol( array $symbol ): void {
		if ( ! isset( $this->symbols[ $symbol['id'] ] ) ) {
			$this->symbols[ $symbol['id'] ] = $symbol;
		}
	}

	public function addEdge( string $from, string $to, string $kind, string $file, int $line ): void {
		$key = "{$from}|{$to}|{$kind}";
		if ( ! isset( $this->edges[ $key ] ) ) {
			$this->edges[ $key ] = array(
				'from' => $from,
				'to'   => $to,
				'kind' => $kind,
				'at'   => $this->at( $file, $line ),
			);
		}
	}

	public function addUnresolved( string $from, string $code, string $file, int $line ): void {
		$this->unresolved[] = array(
			'from' => $from,
			'at'   => $this->at( $file, $line ),
			'code' => $code,
		);
	}

	/** @return array<string, mixed> */
	public function toArray(): array {
		return array(
			'base'       => $this->base,
			'version'    => '',
			'symbols'    => array_values( $this->symbols ),
			'edges'      => array_values( $this->edges ),
			'unresolved' => $this->unresolved,
		);
	}

	/** @return array<string, mixed> */
	private function at( string $file, int $line ): array {
		return array(
			'kind' => 'source',
			'base' => $this->base,
			'file' => $file,
			'from' => $line,
			'to'   => $line,
		);
	}
}
