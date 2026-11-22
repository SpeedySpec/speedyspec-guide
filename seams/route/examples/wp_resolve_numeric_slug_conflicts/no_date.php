<?php
// Only date query vars can clash with a numeric post slug; without them, or without %postname% in the structure, the vars are returned as they are.
$vars = array( 'name' => 'hello' );
$no_date = wp_resolve_numeric_slug_conflicts( $vars );
$no_postname = wp_resolve_numeric_slug_conflicts( array( 'year' => '2026' ) );
return array( $no_date, $no_postname );
