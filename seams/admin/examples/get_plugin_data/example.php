<?php
// A plugin's header fields (name, version, author, requirements and the rest) read from its main file, marked up and translated when asked.
$data = get_plugin_data( WP_PLUGIN_DIR . '/hello.php', false, false );
return array( $data['Name'], $data['Author'], $data['RequiresPHP'] );
