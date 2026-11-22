<?php
// Registers the routes of the full-page Font Library app.
wp_register_font_library_page_routes();
return wp_list_pluck( wp_get_font_library_routes(), 'path' );
