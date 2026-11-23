<?php
// Translates a plugin's header fields with its text domain and adds links and escaping to them for display.
$data = get_plugin_data( WP_PLUGIN_DIR . '/hello.php', false, false );
$marked = _get_plugin_data_markup_translate( 'hello.php', $data );
return array( $marked['Title'], str_contains( $marked['Author'], '<a href=' ) );
