<?php
// Prints the site language select, with the installed and the available languages.
$html = guide_render( fn() => wp_install_language_form( array( 'fr_FR' => array( 'language' => 'fr_FR', 'native_name' => 'Français', 'iso' => array( 'fr' ) ) ) ) );
return array( str_contains( $html, "id='language'" ), str_contains( $html, 'Français' ) );
