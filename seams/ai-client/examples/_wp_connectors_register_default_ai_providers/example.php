<?php
// Registers the AI providers WordPress offers connectors for, such as Anthropic, Google and OpenAI, each with its plugin and API key settings.
$registry = new WP_Connector_Registry();
_wp_connectors_register_default_ai_providers( $registry );
return array_keys( $registry->get_all_registered() );
