<?php
// The font family preset's slug in a font family value (var:preset|font-family|x or var(--wp--preset--font-family--x)); other values as given, null when empty.
guide_theme( 'ipsum' );
require_once get_template_directory() . '/inc/abilities.php';
return array( ipsum_get_design_guide_font_slug( 'var:preset|font-family|manrope' ), ipsum_get_design_guide_font_slug( 'var(--wp--preset--font-family--fira-code)' ), ipsum_get_design_guide_font_slug( 'Georgia, serif' ), ipsum_get_design_guide_font_slug( '' ) );
