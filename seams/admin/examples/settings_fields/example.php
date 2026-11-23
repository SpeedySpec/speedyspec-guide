<?php
// Prints the hidden fields a settings form needs: its option group, the action and the nonce.
$html = guide_render( fn() => settings_fields( 'general' ) );
return array( str_contains( $html, "name='option_page' value='general'" ), str_contains( $html, 'name="_wpnonce"' ) );
