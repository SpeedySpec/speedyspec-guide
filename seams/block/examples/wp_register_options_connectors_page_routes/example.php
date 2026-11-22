<?php
// Registers the routes of the full-page Connectors settings app.
wp_register_options_connectors_page_routes();
return wp_list_pluck( wp_get_options_connectors_routes(), 'path' );
