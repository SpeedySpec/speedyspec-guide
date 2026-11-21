<?php
function new_syntax( $a ) {
	return match ( true ) {
		default => $a?->b,
	};
}

enum Suit: string {
	case Hearts = "H";
}
