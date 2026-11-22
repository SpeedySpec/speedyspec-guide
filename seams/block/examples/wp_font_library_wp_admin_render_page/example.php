<?php
// Prints the Font Library page inside the admin's normal screen.
$html = guide_render( 'wp_font_library_wp_admin_render_page' );
return substr( $html, strrpos( $html, '</style>' ) + 8 );
