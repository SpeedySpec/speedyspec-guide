<?php
// Registers WordPress's own settings for the REST API; on trunk, for the Abilities API too.
register_initial_settings();
$settings = get_registered_settings();
return array( $settings['blogname']['show_in_rest']['name'] ?? null, $settings['blogname']['show_in_abilities'], isset( $settings['wp_page_for_privacy_policy'] ) );
