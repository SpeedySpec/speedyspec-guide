<?php
// Hooked to init: makes the connector registry, registers the default AI providers when AI is supported and Akismet, then fires wp_connectors_init with the registry so plugins add theirs; the registry can only be set during init.
function guide_add_connector( WP_Connector_Registry $registry ): void
{
	$registry->register(
		'my-service',
		array(
			'name'           => 'My Service',
			'description'    => 'An example service.',
			'type'           => 'spam_filtering',
			'plugin'         => array( 'file' => 'my-service/my-service.php', 'is_active' => '__return_true' ),
			'authentication' => array( 'method' => 'api_key', 'credentials_url' => 'https://example.org/keys', 'setting_name' => 'my_service_api_key' ),
		)
	);
}
add_action( 'wp_connectors_init', 'guide_add_connector' );
do_action( 'wp_connectors_init', WP_Connector_Registry::get_instance() );
return array( wp_get_connector( 'my-service' )['name'], wp_is_connector_registered( 'akismet' ) );
