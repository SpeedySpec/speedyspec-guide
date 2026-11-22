<?php
// Prints the plugin installer's ZIP upload form.
$html = guide_render( 'install_plugins_upload' );
return array( str_contains( $html, 'name="pluginzip"' ), str_contains( $html, 'action=upload-plugin' ) );
