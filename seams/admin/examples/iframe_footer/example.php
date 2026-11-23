<?php
// Prints the end of an admin page shown in an iframe: its footer scripts and the closing body and html.
$html = guide_render( 'iframe_footer' );
return str_ends_with( $html, '</html>' );
