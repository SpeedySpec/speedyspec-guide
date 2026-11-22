<?php
// Hooked to rest_api_init: registers the site_icon setting, shown in REST.
register_block_core_site_icon_setting();
$settings = get_registered_settings();
return array( $settings['site_icon']['type'], (bool) $settings['site_icon']['show_in_rest'] );
