<?php
// Where a connector's API key comes from: env for an environment variable, constant for a PHP constant, database for the option, or none.
update_option( 'guide_service_key', 'k-123' );
return array( _wp_connectors_get_api_key_source( 'guide_service_key' ), _wp_connectors_get_api_key_source( 'guide_missing_key' ) );
