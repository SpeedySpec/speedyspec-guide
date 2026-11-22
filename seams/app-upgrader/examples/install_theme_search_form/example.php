<?php
// Prints the old theme installer's search form, with the search type select when asked.
$html = guide_render( fn() => install_theme_search_form( true ) );
return array( str_contains( $html, 'name="type"' ), str_contains( $html, 'name="s"' ) );
