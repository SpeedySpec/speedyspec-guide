<?php
// Registers the routes of the Font Library page inside wp-admin.
wp_register_font_library_wp_admin_page_routes();
return wp_list_pluck( wp_get_font_library_wp_admin_routes(), 'path' );
