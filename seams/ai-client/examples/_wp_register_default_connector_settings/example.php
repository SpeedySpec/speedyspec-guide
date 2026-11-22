<?php
// Hooked to init: registers the setting of each API key or application password connector whose plugin is active, shown in REST and sanitized, unless already registered.
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
_wp_register_default_connector_settings();
$settings = get_registered_settings();
return array( $settings['my_service_api_key']['type'], $settings['my_service_api_key']['label'] );
