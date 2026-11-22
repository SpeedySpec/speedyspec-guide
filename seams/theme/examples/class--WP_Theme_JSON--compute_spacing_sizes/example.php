<?php
// Spacing size presets made from a spacing scale: steps around a medium size with an operator (* or +) and an increment.
$sizes = ( fn() => $this->compute_spacing_sizes( array( 'operator' => '*', 'increment' => 1.5, 'steps' => 5, 'mediumStep' => 1.5, 'unit' => 'rem' ) ) )->call( new WP_Theme_JSON() );
return array_map( fn( $s ) => $s['slug'] . '=' . $s['size'], $sizes );
