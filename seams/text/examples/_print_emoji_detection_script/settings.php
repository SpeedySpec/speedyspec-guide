<?php
// It builds its settings from emoji_url, emoji_ext, emoji_svg_url and emoji_svg_ext before printing; the last filter here stops it to show them.
$seen = array();
foreach ( array( 'emoji_url', 'emoji_ext', 'emoji_svg_url' ) as $hook ) {
	add_filter( $hook, function ( $value ) use ( &$seen, $hook ) { $seen[] = "$hook=$value"; return $value; } );
}
add_filter( 'emoji_svg_ext', function ( $value ) use ( &$seen ) { throw new RuntimeException( implode( ' ', $seen ) . " emoji_svg_ext=$value" ); } );
_print_emoji_detection_script();
