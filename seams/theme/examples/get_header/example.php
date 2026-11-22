<?php
// Loads the theme's header.php (or header-{name}.php), falling back to the bundled compatibility header with a notice; fires get_header. False when no template was found.
add_action( 'get_header', 'guide_note_header' );
function guide_note_header( $name ) {
	$GLOBALS['guide_header'] = $name ?? 'default';
}
$html = guide_render( fn() => get_header( 'shop' ) );
return array( $GLOBALS['guide_header'], str_contains( $html, '<html' ) );
