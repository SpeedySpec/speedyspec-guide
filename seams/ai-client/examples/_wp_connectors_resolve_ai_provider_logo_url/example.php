<?php
// The URL of an AI provider's logo file inside a plugin or must-use plugin, or null when it's elsewhere or missing.
$logo = WP_PLUGIN_DIR . '/hello.php';
return array( _wp_connectors_resolve_ai_provider_logo_url( $logo ), _wp_connectors_resolve_ai_provider_logo_url( '/no/such/logo.svg' ), _wp_connectors_resolve_ai_provider_logo_url( '' ) );
