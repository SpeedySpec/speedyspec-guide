<?php
// Hooked to rest_post_dispatch: masks connector API keys in /wp/v2/settings responses, and checks a new AI provider key, clearing it when the provider rejects it.
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
update_option( 'my_service_api_key', 'abcdefghijkl1234' );
$request = new WP_REST_Request( 'GET', '/wp/v2/settings' );
$server = rest_get_server();
$response = _wp_connectors_rest_settings_dispatch( $server->dispatch( $request ), $server, $request );
return $response->get_data()['my_service_api_key'];
