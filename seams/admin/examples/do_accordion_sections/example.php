<?php
// Prints a screen context's boxes as accordion sections, as the menus screen does.
function guide_tasting_box( $object ): void
{
	echo '<p>Tasting notes</p>';
}
add_meta_box( 'tasting', 'Tasting notes', 'guide_tasting_box', 'nav-menus', 'side' );
$html = guide_render( fn() => do_accordion_sections( 'nav-menus', 'side', null ) );
return array( str_contains( $html, 'accordion-section' ), str_contains( $html, 'Tasting notes' ) );
