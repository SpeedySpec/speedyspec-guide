<?php
// Prints the Connectors settings page inside the admin's normal screen.
$html = guide_render( 'wp_options_connectors_wp_admin_render_page' );
return substr( $html, strrpos( $html, '</style>' ) + 8 );
