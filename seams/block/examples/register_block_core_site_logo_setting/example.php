<?php
// Hooked to rest_api_init: registers the site_logo setting, shown in REST.
register_block_core_site_logo_setting();
$settings = get_registered_settings();
return array( $settings['site_logo']['type'], (bool) $settings['site_logo']['show_in_rest'] );
