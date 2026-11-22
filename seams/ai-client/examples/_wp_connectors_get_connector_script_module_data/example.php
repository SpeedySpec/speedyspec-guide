<?php
// Adds the connectors, with their authentication state and masked keys, to the data the Connectors settings page's script starts with.
$data = _wp_connectors_get_connector_script_module_data( array() );
return array( array_keys( $data ), array_keys( $data['connectors'] ?? array() ) );
