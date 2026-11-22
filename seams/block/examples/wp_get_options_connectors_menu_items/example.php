<?php
// The registered menu items of the full-page Connectors settings app.
wp_register_options_connectors_menu_item( 'my-plugin', 'My Plugin', '/my-plugin' );
return wp_get_options_connectors_menu_items();
