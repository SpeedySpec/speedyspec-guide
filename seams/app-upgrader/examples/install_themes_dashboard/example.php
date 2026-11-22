<?php
// Prints the old theme installer's Search tab: the search form and the feature filter.
$html = guide_render( 'install_themes_dashboard' );
return str_contains( $html, 'search' );
