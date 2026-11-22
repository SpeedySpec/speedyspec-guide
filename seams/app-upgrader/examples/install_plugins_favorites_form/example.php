<?php
// Prints the form asking for a WordPress.org username to list its favorite plugins.
$html = guide_render( 'install_plugins_favorites_form' );
return str_contains( $html, 'name="user"' );
