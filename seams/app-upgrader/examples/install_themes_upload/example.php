<?php
// Prints the theme installer's ZIP upload form.
$html = guide_render( 'install_themes_upload' );
return array( str_contains( $html, 'name="themezip"' ), str_contains( $html, 'action=upload-theme' ) );
