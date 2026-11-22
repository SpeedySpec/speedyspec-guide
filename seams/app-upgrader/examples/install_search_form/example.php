<?php
// Prints the plugin installer's search form.
$html = guide_render( 'install_search_form' );
return array( str_contains( $html, 'search-plugins' ), str_contains( $html, 'name="s"' ) );
