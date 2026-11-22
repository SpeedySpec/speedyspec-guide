<?php
// Fixes the source of the admin color scheme style (the user's scheme, modern by default, keeping its query) and of styles while installing; on style_loader_src.
require_once ABSPATH . 'wp-admin/includes/misc.php';
register_admin_color_schemes();
return array( wp_style_loader_src( '/wp-admin/css/colors.css?ver=1', 'colors' ), wp_style_loader_src( '/x.css', 'other' ) );
