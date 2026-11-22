<?php
// Deprecated in 3.3.0. Add the "Dashboard"/"Visit Site" menu. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
require_once ABSPATH . WPINC . '/class-wp-admin-bar.php';
return guide_deprecated( 'wp_admin_bar_dashboard_view_site_menu', new WP_Admin_Bar() );
