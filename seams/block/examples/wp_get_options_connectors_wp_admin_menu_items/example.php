<?php
// The registered menu items of the Connectors settings page inside wp-admin.
wp_register_options_connectors_wp_admin_menu_item( 'my-plugin', 'My Plugin', '/my-plugin' );
return wp_get_options_connectors_wp_admin_menu_items();
