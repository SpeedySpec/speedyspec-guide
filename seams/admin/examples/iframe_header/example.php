<?php
// Prints the start of an admin page shown in an iframe, such as the old media dialog: head, styles, scripts and the opening body.
$html = guide_render( fn() => iframe_header( 'Tea' ) );
return array( str_contains( $html, '<title>' ), str_contains( $html, '<body' ) );
