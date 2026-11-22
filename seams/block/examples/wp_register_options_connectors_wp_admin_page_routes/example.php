<?php
// Registers the routes of the Connectors settings page inside wp-admin.
wp_register_options_connectors_wp_admin_page_routes();
return wp_list_pluck( wp_get_options_connectors_wp_admin_routes(), 'path' );
