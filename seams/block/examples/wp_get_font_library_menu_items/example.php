<?php
// The registered menu items of the full-page Font Library app.
wp_register_font_library_menu_item( 'my-plugin', 'My Plugin', '/my-plugin' );
return wp_get_font_library_menu_items();
