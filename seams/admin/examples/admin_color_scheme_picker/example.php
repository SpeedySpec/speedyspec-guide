<?php
// Prints the profile screen's admin color scheme picker, with each scheme's colors.
register_admin_color_schemes();
$html = guide_render( fn() => admin_color_scheme_picker( get_current_user_id() ) );
return array( str_contains( $html, 'color-picker' ), str_contains( $html, 'value="ectoplasm"' ) );
